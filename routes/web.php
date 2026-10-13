<?php

use App\Http\Controllers\settings\BranchController;
use App\Http\Controllers\settings\CompanyController;
use App\Http\Controllers\settings\ProfileController;
use App\Http\Controllers\settings\RoleController;
use App\Http\Controllers\settings\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('settings.profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])
        ->name('settings.roles.index');

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('settings.roles.create');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('settings.roles.store');

    Route::get('/roles/{encryptedRole}/edit', [RoleController::class, 'edit'])
        ->name('settings.roles.edit');

    Route::put('/roles/{encryptedRole}/update', [RoleController::class, 'update'])
        ->name('settings.roles.update');

    Route::delete('/roles/{encryptedRole}', [RoleController::class, 'destroy'])
        ->name('settings.roles.destroy');

    // Settings
    Route::view('/settings', 'settings.index')
        ->name('settings.index');

// Employees: Create
Route::middleware('can:employees.create')->group(function () {
    Route::get('/users-and-roles/create', [UserController::class, 'create'])
        ->name('settings.users.create');

    Route::post('/users-and-roles', [UserController::class, 'store'])
        ->name('settings.users.store');
});

// Employees: Inactive Users
Route::get('/users-and-roles/inactive', [UserController::class, 'inactive'])
    ->middleware('can:employees.view')
    ->name('settings.users.inactive');

// Employees: View
Route::middleware('can:employees.view')->group(function () {
    Route::get('/users-and-roles', [UserController::class, 'index'])
        ->name('settings.users.index');

    Route::get('/users-and-roles/{encryptedUser}', [UserController::class, 'show'])
        ->name('settings.users.show');
});

// Employees: Edit
Route::middleware('can:employees.edit')->group(function () {
    Route::get('/users-and-roles/{encryptedUser}/edit', [UserController::class, 'edit'])
        ->name('settings.users.edit');

    Route::put('/users-and-roles/{encryptedUser}', [UserController::class, 'update'])
        ->name('settings.users.update');
});

// Employees: Activate
Route::patch('/users-and-roles/{encryptedUser}/activate', [UserController::class, 'activate'])
    ->middleware('can:employees.activate')
    ->name('settings.users.activate');

// Employees: Deactivate
Route::patch('/users-and-roles/{encryptedUser}/deactivate', [UserController::class, 'deactivate'])
    ->middleware('can:employees.deactivate')
    ->name('settings.users.deactivate');

// Employees: Delete
Route::delete('/users-and-roles/{encryptedUser}', [UserController::class, 'destroy'])
    ->middleware('can:employees.delete')
    ->name('settings.users.destroy');

    // Companies
    Route::prefix('user-companies')
        ->name('settings.user-companies.')
        ->group(function () {

            Route::get('/', [CompanyController::class, 'index'])
                ->name('index');

            Route::get('/create', [CompanyController::class, 'create'])
                ->name('create');

            Route::post('/', [CompanyController::class, 'store'])
                ->name('store');

            Route::get('/{company}', [CompanyController::class, 'show'])
                ->name('show');

            Route::get('/{company}/edit', [CompanyController::class, 'edit'])
                ->name('edit');

            Route::put('/{company}', [CompanyController::class, 'update'])
                ->name('update');

            Route::delete('/{company}', [CompanyController::class, 'destroy'])
                ->name('destroy');

            Route::patch('/{company}/status', [CompanyController::class, 'toggleStatus'])
                ->name('status');
     });
     // Branches
        Route::resource('branches', BranchController::class)
            ->names('settings.branches');

});

require __DIR__.'/auth.php';