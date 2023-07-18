<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\AppointmentsAdministrationController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ClientAppointmentController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardCustomersController;
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

/*
 * Appointment Confirmation
 */
Route::get('/app/customers/confirm/{Token}', [ClientAppointmentController::class, 'ConfirmAppointment'])->name('appointment.customers.confirm');
Route::get('/app/customers/unconfirm/{Token}', [ClientAppointmentController::class, 'UnConfirmAppointment'])->name('appointment.customers.unconfirm');

/*
 * Customer Dashboard
*/
Route::middleware(['auth','KillSession'])->group(function (){
    /*
     * Auth
     */
    Route::get('/app/logout', [AuthentificationController::class, 'LogOut'])->name('auth.logout');
    /*
     * Dashboard
     */
    Route::get('/app/dashboard', DashboardCustomersController::class)->name('customer.dashboard');
    /*
     * Customer Settings
    */
    Route::get('/app/customers/settings', [CustomersController::class, 'AccountSettingsView'])->name('customers.settings');
    Route::post('/app/customers/settings/update/information', [CustomersController::class, 'UpdateAccountInformation'])->name('customers.settings.update.informations');
    Route::post('/app/customers/settings/update/password', [CustomersController::class, 'UpdatePasswordAccount'])->name('customers.settings.update.password');

    /*
     * Appointment
     */
    Route::get('/app/customers/appointment/view/type', ClientAppointmentController::class)->name('customers.appointment.type.view');
    Route::get('/app/customers/appointment/view/type/view/{IdAppointmentType}', [ClientAppointmentController::class, 'ViewAppointmentType'])->name('customers.appointment.type.view.target');
    Route::get('/app/customers/appointment/register/{IdAppointment}', [ClientAppointmentController::class, 'RegisterForAppointment'])->name('customers.appointment.register');
    Route::get('/app/customers/appointment/my/view/{IdRegistration}', [ClientAppointmentController::class,'ViewMyAppointment'])->name('customers.appointment.my.view');
    Route::get('/app/customers/appointment/cancel/{IdRegistration}', [ClientAppointmentController::class, 'CancelAppointment'])->name('customers.appointment.cancel');

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
        Route::post('/app/administration/members/update/rank', [AdministrationController::class, 'UpdateUserRank'])->name('admin.members.update.rank');
        Route::post('/app/administration/members/update/block', [AdministrationController::class, 'BlockUserAccount'])->name('admin.members.update.block');
        Route::get('/app/administration/members/view/suspended', [AdministrationController::class, 'ViewSuspendedUsersList'])->name('admin.members.suspended.view');
        Route::get('/app/administration/members/delete/account/{IdAccount}' , [AdministrationController::class, 'DeleteUserAccount'])->name('admin.members.delete.account');
        /*
         * Appointment Type
        */
        Route::get('/app/administration/appointment/type/view', AppointmentTypeController::class)->name('admin.appointment.type.view');
        Route::post('/app/administration/appointment/type/add', [AppointmentTypeController::class, 'AddAppointmentType'])->name('admin.appointment.type.add');
        Route::get('/app/administration/appointment/type/view/{IdAppointmentType}', [AppointmentTypeController::class, 'ViewAppointmentType'])->name('admin.appointment.type.view.target');
        Route::post('/app/administration/appointment/type/update', [AppointmentTypeController::class, 'UpdateAppointmentType'])->name('admin.appointment.type.update');
        Route::get('/app/administration/appointment/type/delete/{IdAppointmentType}', [AppointmentTypeController::class, 'DeleteAppointmentType'])->name('admin.appointment.type.delete');
        /*
         * Appointment
         */
        Route::post('/app/administration/appointment/add', [AppointmentsAdministrationController::class, 'AddAppointment'])->name('admin.appointment.add');
        Route::post('/app/administration/appointment/force/register/user', [AppointmentsAdministrationController::class, 'ForceRegisterUser'])->name('admin.appointment.force.register.user');
        Route::get('/app/administration/appointment/delete/{IdAppointment}', [AppointmentsAdministrationController::class, 'RemoveAppointment'])->name('admin.appointment.remove');
        Route::post('/app/administration/appointment/update',[AppointmentsAdministrationController::class, 'UpdateAppointment'])->name('admin.appointment.update');
        Route::get('/app/administration/appointment/view/{IdAppointment}', [AppointmentsAdministrationController::class, 'ViewAppointment'])->name('admin.appointment.view');
        Route::get('app/administration/appointment/archive/{IdAppointment}', [AppointmentsAdministrationController::class, 'ArchiveAppointment'])->name('admin.appointment.archive');
        Route::get('/app/administration/appointment/registration/updateStatus/{IdRegistration}/{Value}', [AppointmentsAdministrationController::class, 'UpdateStatusRegistration'])->name('admin.appointment.registration.update');

        /*
         * Ajax Calls
         */
            /*
             * Members View Ajax
             */
            Route::post('/app/administration/members/view/ajax', [AdministrationController::class, 'ViewUserAjaxForModal'])->name('admin.members.view.ajax');

    });

});
