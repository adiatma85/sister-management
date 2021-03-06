<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\ChangePasswordController as AuthChangePasswordController;

// Admin
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PermissionsController as AdminPermissionController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\UsersController as AdminUserController;
use App\Http\Controllers\Admin\SisterController as AdminSisterController;
use App\Http\Controllers\Admin\KlienController as AdminKlienController;
use App\Http\Controllers\Admin\ContractController as AdminContractController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth
Auth::routes(['register' => false]);

// Redirect Home
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

// Admin
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth'])
    ->group(function () {
        // Home
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');

        // Permissions
        Route::delete('/permission/destroy', [AdminPermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
        Route::resource('permissions', AdminPermissionController::class);

        // Roles
        Route::delete('/roles/destroy', [AdminRolesController::class, 'massDestroy'])->name('roles.massDestroy');
        Route::resource('roles', AdminRolesController::class);

        // Users
        Route::delete('users/destroy', [AdminUserController::class, 'massDestroy'])->name('users.massDestroy');
        Route::resource('users', AdminUserController::class);

        // Sister
        Route::prefix('sisters')
            ->as('sisters.')
            ->group(function () {

                // Handle
                Route::prefix('handle')
                    ->as('handle.')
                    ->group(function () {
                        Route::get('city/{provinceId}', [AdminSisterController::class, 'handleCity'])->name('city');
                        Route::get('sub-district/{cityId}', [AdminSisterController::class, 'handleSubDistrict'])->name('subDisctrict');
                        Route::get('ward/{subDistrictId}', [AdminSisterController::class, 'handleWard'])->name('ward');
                    });

                Route::delete('destroy', [AdminSisterController::class, 'massDestroy'])->name('massDestroy');
                Route::post('media', [AdminSisterController::class, 'storeMedia'])->name('storeMedia');
                Route::post('ckmedia', [AdminSisterController::class, 'storeCKEditorImages'])->name('storeCKEditorImages');
            });
        Route::resource('sisters', AdminSisterController::class);

        // Klien
        Route::prefix('kliens')
            ->as('kliens.')
            ->group(function () {

                // Handle
                Route::prefix('handle')
                    ->as('handle.')
                    ->group(function () {
                        Route::get('city/{provinceId}', [AdminKlienController::class, 'handleCity'])->name('city');
                        Route::get('sub-district/{cityId}', [AdminKlienController::class, 'handleSubDistrict'])->name('subDisctrict');
                        Route::get('ward/{subDistrictId}', [AdminKlienController::class, 'handleWard'])->name('ward');
                    });

                Route::delete('destroy', [AdminKlienController::class, 'massDestroy'])->name('massDestroy');
                Route::post('media', [AdminKlienController::class, 'storeMedia'])->name('storeMedia');
                Route::post('ckmedia', [AdminKlienController::class, 'storeCKEditorImages'])->name('storeCKEditorImages');
            });

        Route::resource('kliens', AdminKlienController::class);

        // Contract
        Route::delete('contracts/destroy', [AdminContractController::class, 'massDestroy'])->name('contracts.massDestroy');
        Route::resource('contracts', AdminContractController::class);
    });

// Profile
Route::prefix('profile')
    ->as('profile.')
    ->middleware(['auth'])
    ->group(function () {
        if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
            Route::get('password', [AuthChangePasswordController::class, 'edit'])->name('password.edit');
            Route::post('password', [AuthChangePasswordController::class, 'update'])->name('password.update');
            Route::post('profile', [AuthChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
            Route::post('profile/destroy', [AuthChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
        }
    });
