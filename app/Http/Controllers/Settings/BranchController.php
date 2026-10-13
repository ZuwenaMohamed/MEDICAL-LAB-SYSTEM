<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BranchController extends Controller
{
    public function index(): View
    {
        $branches = Branch::with('company')
            ->latest()
            ->paginate(10);

        return view('settings.branches.index', compact('branches'));
    }

    public function create(): View
    {
        $companies = Company::where('status', true)
            ->orderBy('name')
            ->get();

        return view('settings.branches.create', compact('companies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_id' => [
                'required',
                'integer',
                'exists:companies,id',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('branches', 'code')
                    ->where('company_id', $request->company_id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'is_main' => [
                'sometimes',
                'boolean',
            ],
            'status' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $validated['is_main'] = $request->boolean('is_main');
        $validated['status'] = $request->boolean('status');

        if ($validated['is_main']) {
            Branch::where('company_id', $validated['company_id'])
                ->update(['is_main' => false]);
        }

        Branch::create($validated);

        return redirect()
            ->route('settings.branches.index')
            ->with('action_completed', 'Created')
            ->with('success', 'Branch was created successfully.');
    }

    public function show(Branch $branch): View
    {
        $branch->load(['company', 'users']);

        return view('settings.branches.show', compact('branch'));
    }

    public function edit(Branch $branch): View
    {
        $companies = Company::where('status', true)
            ->orWhere('id', $branch->company_id)
            ->orderBy('name')
            ->get();

        return view('settings.branches.edit', compact('branch', 'companies'));
    }

    public function update(Request $request, Branch $branch): RedirectResponse
    {
        $validated = $request->validate([
            'company_id' => [
                'required',
                'integer',
                'exists:companies,id',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('branches', 'code')
                    ->where('company_id', $request->company_id)
                    ->ignore($branch->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:255',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'is_main' => [
                'sometimes',
                'boolean',
            ],
            'status' => [
                'sometimes',
                'boolean',
            ],
        ]);

        $validated['is_main'] = $request->boolean('is_main');
        $validated['status'] = $request->boolean('status');

        if ($validated['is_main']) {
            Branch::where('company_id', $validated['company_id'])
                ->where('id', '!=', $branch->id)
                ->update(['is_main' => false]);
        }

        $branch->update($validated);

        return redirect()
            ->route('settings.branches.index')
            ->with('action_completed', 'Updated')
            ->with('success', 'Branch was updated successfully.');
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        try {
            $branch->delete();

            return redirect()
                ->route('settings.branches.index')
                ->with('action_completed', ' Succesfully Deleted')
                ->with('success', 'Branch was deleted successfully.');
        } catch (QueryException $exception) {
            return redirect()
                ->route('settings.branches.index')
                ->with(
                    'error',
                    'This branch cannot be deleted because it has related records.'
                );
        }
    }
}