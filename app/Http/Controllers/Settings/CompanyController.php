<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(Request $request): View
    {
        $companies = Company::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('settings.companies.index', compact('companies'));
    }

    public function create(): View
    {
        $companies = Company::latest()->paginate(10);

        return view('settings.companies.index', [
            'companies' => $companies,
            'section' => 'create',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:companies,code'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'brand_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'status' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('companies/logos', 'public');
        }

        $validated['status'] = $request->boolean('status', true);

        Company::create($validated);

        return redirect()
            ->route('settings.user-companies.index')
            ->with('action_completed', 'Created')
            ->with('success', 'Company was registered successfully.');
    }

    public function show(Company $company): View
    {
        $companies = Company::latest()->paginate(10);

        return view('settings.companies.index', [
            'companies' => $companies,
            'selectedCompany' => $company,
            'section' => 'show',
        ]);
    }

    public function edit(Company $company): View
    {
        $companies = Company::latest()->paginate(10);

        return view('settings.companies.index', [
            'companies' => $companies,
            'selectedCompany' => $company,
            'section' => 'edit',
        ]);
    }

    public function update(Request $request, Company $company): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:255',
                'unique:companies,code,' . $company->id,
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'brand_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'status' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('companies/logos', 'public');
        }

        $validated['status'] = $request->boolean(
            'status',
            (bool) $company->status
        );

        $company->update($validated);

        return redirect()
            ->route('settings.user-companies.index')
            ->with('action_completed', 'Updated')
            ->with('success', 'Company was updated successfully.');
    }

    public function destroy(Company $company): RedirectResponse
    {
        try {
            $company->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route('settings.user-companies.index')
                ->with(
                    'error',
                    'This company cannot be deleted because it is linked to users or other records.'
                );
        }

        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        return redirect()
            ->route('settings.user-companies.index')
            ->with('action_completed', 'Deleted')
            ->with('success', 'Company was deleted successfully.');
    }

    public function toggleStatus(Company $company): RedirectResponse
    {
        $company->update([
            'status' => ! $company->status,
        ]);

        $status = $company->status ? 'activated' : 'deactivated';

        $actionCompleted = $company->status
            ? 'Activated'
            : 'Deactivated';

        return redirect()
            ->route('settings.user-companies.index')
            ->with('action_completed', $actionCompleted)
            ->with(
                'success',
                "Company was successfully {$status}."
            );
    }
}