<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 * Guest
*/
Route::get('/',GuestController::class)->name('app.guest');

/*
 * Authentification
*/
Route::get('/app/register', AuthentificationController::class)->name('auth.register');
Route::post('/app/register', [AuthentificationController::class, 'Register'])->name('auth.register.confirm');
Route::get('/app/login', [AuthentificationController::class, 'Login'])->name('auth.login');
Route::post('/app/login', [AuthentificationController::class, 'LoginAttempt'])->name('auth.login.confirm');
Route::get('/app/logout', [AuthentificationController::class, 'LogOut'])->name('auth.logout');

/*
 * Customer Dashboard
*/
Route::middleware(['auth'])->group(function (){
    /*
     * Dashboard
     */
    Route::get('/app/dashboard', \App\Http\Controllers\DashboardCustomersController::class)->name('customer.dashboard');
    /*
     * Customer Settings
    */
    Route::get('/app/customers/settings', [CustomersController::class, 'AccountSettingsView'])->name('customers.settings');
    Route::post('/app/customers/settings/update/information', [CustomersController::class, 'UpdateAccountInformation'])->name('customers.settings.update.informations');
    Route::post('/app/customers/settings/update/password', [CustomersController::class, 'UpdatePasswordAccount'])->name('customers.settings.update.password');

    /*
     * Administration Route
     */
    Route::middleware(['AdministrationMember'])->group(function(){
        /*
         * Dashboard
         */
        Route::get('/app/administration/dashboard', DashboardAdminController::class)->name('admin.dashboard');
        /*
         * Members
         */
        Route::get('/app/administration/members/view', [AdministrationController::class, 'ViewUsersList'])->name('admin.members.view');

    });

});


/*
 * Errors Route
 */
