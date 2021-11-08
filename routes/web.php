<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Academic\AcademicMembersController;
use App\Http\Controllers\Admin\Academic\AcademicSubscriptionController;
use App\Http\Controllers\Admin\Academic\AcademicRenewalsController;
use App\Http\Controllers\Admin\Academic\AcademicApplicationController;
use App\Http\Controllers\Memberships\OrganizationsController;
use App\Http\Controllers\User\UserOrganizationsController;
use App\Http\Controllers\User\UserSubscriptionsController;
use App\Http\Controllers\User\UserApplicationsController;
use App\Imports\ExpectedStudentsImport;

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

Route::get('/membership-homepage', function () {
    return view('index');
});

Route::get('/membership', function () {
    return view('membership.welcome');
})->middleware('auth');

//password update

Route::view('/profile/password', 'auth.update-password')->middleware(['auth','verified']);

//membership routes

Route::prefix('membership')->middleware(['auth'])->name('membership.')->group(function () {

    //admin routes
    Route::prefix('admin')->middleware(['auth','auth.isAdmin','verified'])->name('admin.')->group(function () {
        Route::get('profile', ProfileController::class)->name('profile');
        Route::resource('users', UserController::class);
        Route::get('/member/renewals', [AcademicRenewalsController::class, 'index'])->name('member-renewals');
        Route::resource('/member/subscriptions', AcademicSubscriptionController::class);
        Route::resource('/member/academic/official', AcademicMembersController::class);
        Route::resource('/member/applications', AcademicApplicationController::class);
        Route::post('/import', [UserController::class, 'importStudents'])->name('expectedstudent-import');
    });
    
    //users
    Route::prefix('user')->middleware(['auth','auth.isStudent','verified'])->name('user.')->group(function () {

        Route::get('my-organizations', [UserOrganizationsController::class, 'index'])->name('my-organizations');
        Route::get('my-subscriptions', [UserSubscriptionsController::class, 'index'])->name('my-subscriptions');
        Route::get('my-applications', [UserApplicationsController::class, 'index'])->name('my-applications');
        Route::post('my-applications', [UserApplicationsController::class, 'store'])->name('apply');
        
    });
});