<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Academic\AcademicMembersController;
use App\Http\Controllers\Admin\Academic\AcademicPaymentsController;
use App\Http\Controllers\Admin\Academic\AcademicRenewalsController;
use App\Http\Controllers\Admin\Academic\AcademicApplicationController;
use App\Http\Controllers\Admin\Membership\Academic\AcademicMembershipController;
use App\Http\Controllers\Admin\Membership\Nonacademic\NonacademicMembershipController;
use App\Http\Controllers\User\UserOrganizationsController;

use App\Http\Controllers\User\UserApplicationsController;
use App\Http\Controllers\InformationVerificationController;
use App\Http\Controllers\User\Academic\AcademicApplicationsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\User\Nonacademic\NonacademicApplicationController;


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
    return view('auth.login');
});


Route::get('/membership', function () {
    return view('membership.welcome');
})->middleware('auth');

//verifystudentinformation

Route::get('/verify', [InformationVerificationController::class, 'index'])->name('verify-applicant');
Route::post('/information-verify', [InformationVerificationController::class, 'verifyInformation'])->name('information-verify');
Route::post('/store-user', [InformationVerificationController::class, 'store'])->name('store-user');

//password update

Route::view('/profile/password', 'auth.update-password')->middleware(['auth']);

//membership routes

Route::prefix('membership')->middleware('auth')->name('membership.')->group(function () {

    //admin routes
    Route::prefix('admin')->middleware(['auth','auth.isAdmin'])->name('admin.')->group(function () {
        Route::get('profile', ProfileController::class)->name('profile');
        Route::resource('users', UserController::class);

        Route::get('/members/renewals', [AcademicRenewalsController::class, 'index'])->name('member-renewals');

        Route::get('/members/academic/payments/filter', [AcademicPaymentsController::class, 'filterPayments'])->name('filterPayment');
        Route::resource('/members/academic/payments', AcademicPaymentsController::class);


        Route::resource('/members/academic/official', AcademicMembersController::class);
        Route::post('/members/academic/message/{member}',[ AcademicMembersController::class, 'messageMember'])->name('message-member');
        Route::get('/members/academic/filter' , [AcademicMembersController::class, 'filterMembers'])->name('member-filter');

        Route::resource('/members/academic/applications', AcademicApplicationController::class);
        Route::post('/import', [UserController::class, 'importStudents'])->name('expectedstudent-import');

        //Route::post('/addacademicmembership', [AddAcademicMembershipController::class, 'addMembership'])->name('addacademic');
        Route::resource('/academicmembership', AcademicMembershipController::class);
        Route::resource('/nonacademicmembership', NonAcademicMembershipController::class);
    });
     
    //users routes
    Route::prefix('user')->middleware(['auth','auth.isStudent'])->name('user.')->group(function () {
        Route::prefix('academic')->name('academic.')->group(function () {
            
            Route::get('application-form', [AcademicApplicationsController::class, 'showForm'])->name('academic-application');
            Route::post('application',[AcademicApplicationsController::class, 'store'])->name('application-store');
            
        });
        Route::prefix('nonacademic')->name('nonacademic.')->group(function () {
            
            Route::get('application-form', [NonacademicApplicationController::class, 'showForm'])->name('nonacademic-application');

        });
        Route::get('messages', [MessagesController::class, 'index'])->name('messages');
        Route::get('my-organizations', [UserOrganizationsController::class, 'index'])->name('my-organizations');
        //Route::get('my-subscriptions', [UserSubscriptionsController::class, 'index'])->name('my-subscriptions');
        Route::get('my-applications', [UserApplicationsController::class, 'index'])->name('my-applications');
        Route::post('my-applications', [UserApplicationsController::class, 'store'])->name('apply');
        //Route::get('application-form', [UserApplicationsController::class, 'applicationForm'])->name('application-form');

        
    });    
});
