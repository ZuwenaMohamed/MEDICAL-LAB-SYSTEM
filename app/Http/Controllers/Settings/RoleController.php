<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::with('permissions')
            ->orderBy('name')
            ->paginate(10);

        $features = Feature::with([
            'permissions' => function ($query) {
                $query->orderBy('name');
            },
        ])
            ->orderBy('name')
            ->get();

        return view('settings.roles.index', compact('roles', 'features'));
    }

    public function create(): View
    {
        $features = Feature::with([
            'permissions' => function ($query) {
                $query->orderBy('name');
            },
        ])
            ->orderBy('name')
            ->get();

        return view('settings.roles.create', compact('features'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        $permissions = Permission::whereIn(
            'id',
            $validated['permissions'] ?? []
        )->get();

        $role->syncPermissions($permissions);

        return redirect()
            ->route('settings.roles.index')
            ->with('action_completed', 'Created')
            ->with('success', 'Role was created successfully.');
    }

    public function edit(string $encryptedRole): View
    {
        try {
            $roleId = Crypt::decryptString($encryptedRole);
        } catch (DecryptException $exception) {
            abort(404);
        }

        $role = Role::findOrFail($roleId);

        $features = Feature::with([
            'permissions' => function ($query) {
                $query->orderBy('name');
            },
        ])
            ->orderBy('name')
            ->get();

        $assignedPermissions = $role->permissions()
            ->pluck('permissions.id')
            ->toArray();

        return view('settings.roles.edit', compact(
            'role',
            'features',
            'assignedPermissions'
        ));
    }

    public function update(Request $request, string $encryptedRole)
    {
        try {
            $roleId = Crypt::decryptString($encryptedRole);
        } catch (DecryptException $exception) {
            abort(404);
        }

        $role = Role::findOrFail($roleId);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name,' . $role->id,
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role->update([
            'name' => $validated['name'],
        ]);

        $permissions = Permission::whereIn(
            'id',
            $validated['permissions'] ?? []
        )->get();

        $role->syncPermissions($permissions);

        return redirect()
            ->route('settings.roles.index')
            ->with('action_completed', 'Updated')
            ->with('success', 'Role was updated successfully.');
    }

    public function destroy(string $encryptedRole)
    {
        try {
            $roleId = Crypt::decryptString($encryptedRole);
        } catch (DecryptException $exception) {
            abort(404);
        }

        $role = Role::findOrFail($roleId);

        if ($role->name === 'Super Administrator') {
            return redirect()
                ->route('settings.roles.index')
                ->with('error', 'The Super Administrator role cannot be deleted.');
        }

        if ($role->users()->exists()) {
            return redirect()
                ->route('settings.roles.index')
                ->with('error', 'This role cannot be deleted because it is assigned to users.');
        }

        $role->delete();

        return redirect()
            ->route('settings.roles.index')
            ->with('action_completed', 'Deleted')
            ->with('success', 'Role was deleted successfully.');
    }
}