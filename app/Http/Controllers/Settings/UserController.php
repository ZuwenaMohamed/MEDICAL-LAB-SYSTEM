<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('branch_id')) {
            $validated = $request->validate([
                'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            ]);

            if ($validated['branch_id'] === null) {
                $request->session()->forget('selected_branch_id');
            } else {
                $request->session()->put(
                    'selected_branch_id',
                    (int) $validated['branch_id']
                );
            }
        }

        $selectedBranchId = $request->session()->get('selected_branch_id');

        $branches = Branch::with('company')
            ->orderBy('company_id')
            ->orderBy('name')
            ->get();

        $usersQuery = User::where('status', true);

        if ($selectedBranchId) {
            $usersQuery->whereHas('branches', function ($query) use ($selectedBranchId) {
                $query->where('branches.id', $selectedBranchId);
            });
        }

        $users = $usersQuery
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('settings.users.index', compact(
            'users',
            'branches',
            'selectedBranchId'
        ));
    }

    
    public function inactive()
    {
        $users = User::where('status', false)
            ->latest()
            ->paginate(10);

        return view('settings.users.inactive', compact('users'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
        ]);

        if (!empty($validated['branch_id'])) {
            $selectedBranchId = (int) $validated['branch_id'];

            $request->session()->put(
                'selected_branch_id',
                $selectedBranchId
            );
        } else {
            $selectedBranchId = $request->session()->get('selected_branch_id');
        }

        $selectedBranch = $selectedBranchId
            ? Branch::findOrFail($selectedBranchId)
            : null;

        $roles = Role::orderBy('name')->get();

        return view('settings.users.create', compact(
            'roles',
            'selectedBranchId',
            'selectedBranch'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'employee_number' => [
                'nullable',
                'string',
                'max:255',
                'unique:users,employee_number',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
            'role' => ['required', 'exists:roles,name'],
            'branch_id' => ['required', 'integer', 'exists:branches,id'],
        ]);

        $branchId = (int) $validated['branch_id'];

        DB::transaction(function () use ($validated, $branchId) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'employee_number' => $validated['employee_number'] ?? null,
                'password' => Hash::make($validated['password']),
                'status' => true,
            ]);

            $user->syncRoles([$validated['role']]);

            $user->branches()->sync([$branchId]);
        });

        $request->session()->put('selected_branch_id', $branchId);

        return redirect()
            ->route('settings.users.index')
            ->with('action_completed', 'Created')
            ->with('success', 'Employee account was created successfully.');
    }

    public function show(string $encryptedUser)
    {
        $user = User::findOrFail(
            Crypt::decryptString($encryptedUser)
        );

        return view('settings.users.show', compact('user'));
    }

    public function edit(string $encryptedUser)
    {
        $user = User::findOrFail(
            Crypt::decryptString($encryptedUser)
        );

        $roles = Role::orderBy('name')->get();

        return view('settings.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $encryptedUser)
    {
        $user = User::findOrFail(
            Crypt::decryptString($encryptedUser)
        );

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'employee_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'employee_number')->ignore($user->id),
            ],
            'password' => [
                'nullable',
                'confirmed',
                Password::defaults(),
            ],
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->employee_number = $validated['employee_number'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('settings.users.index')
            ->with('action_completed', 'Updated')
            ->with('success', 'Employee account was updated successfully.');
    }

    public function activate(string $encryptedUser)
    {
        $user = User::findOrFail(
            Crypt::decryptString($encryptedUser)
        );

        $user->status = true;
        $user->save();

        return back()
            ->with('action_completed', 'Activated')
            ->with('success', 'User was successfully activated and can access the system again.');
    }

    public function deactivate(string $encryptedUser)
    {
        $user = User::findOrFail(
            Crypt::decryptString($encryptedUser)
        );

        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot deactivate your own account.'
            );
        }

        $user->status = false;
        $user->save();

        return back()
            ->with('action_completed', 'Deactivated')
            ->with('success', 'User was successfully deactivated from accessing the system.');
    }

    public function destroy(string $encryptedUser)
    {
        $user = User::findOrFail(
            Crypt::decryptString($encryptedUser)
        );

        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }

        $user->delete();

        return redirect()
            ->route('settings.users.index')
            ->with('action_completed', 'Removed')
            ->with('success', 'Employee account was successfully removed.');
    }
}
