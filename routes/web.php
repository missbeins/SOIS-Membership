<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Academic\AcademicMembersController;
use App\Http\Controllers\Admin\Academic\AcademicPaymentsController;
use App\Http\Controllers\Admin\Academic\AcademicApplicationController;
use App\Http\Controllers\Admin\Membership\Academic\AcademicMembershipController;
use App\Http\Controllers\Admin\Membership\Nonacademic\NonacademicMembershipController;

use App\Http\Controllers\User\Academic\UserOrganizationsController;
use App\Http\Controllers\User\Academic\UserApplicationsController;
use App\Http\Controllers\User\Academic\UserAcademicApplicationsController;
use App\Http\Controllers\User\Academic\AcademicMessagesController;

use App\Http\Controllers\User\Nonacademic\UserNonacademicApplicationController;

use App\Http\Controllers\InformationVerificationController;


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

        //USER CONTROLLER ROUTES
        Route::get('profile', ProfileController::class)->name('profile');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::put('users/{user}/{courseId}', [UserController::class, 'update'])->name('users.update');
        Route::get('users/{user}/{courseId}', [UserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit/{courseId}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/import', [UserController::class, 'importStudents'])->name('expectedstudent-import');

        //ACADEMIC PAYMENTS CONTROLLER ROUTES
        Route::get('/members/academic/payments/filter', [AcademicPaymentsController::class, 'filterPayments'])->name('academicfilterPayment');
        Route::get('/members/academic/payments', [AcademicPaymentsController::class, 'index'])->name('academicpayment.index');
        Route::post('/members/academic/payments', [AcademicPaymentsController::class, 'store'])->name('academicpayment.store');
        Route::get('/members/academic/payments/create', [AcademicPaymentsController::class, 'create'])->name('academicpayment.create');
        Route::put('/members/academic/payments/{payment}/{orgId}', [AcademicPaymentsController::class, 'update'])->name('academicpayment.update');
        Route::get('/members/academic/payments/{payment}/{orgId}', [AcademicPaymentsController::class, 'show'])->name('academicpayment.show');
        Route::get('/members/academic/payments/{payment}/edit/{orgId}', [AcademicPaymentsController::class, 'edit'])->name('academicpayment.edit');

        //ACADEMIC MEMBERS CONTROLLER ROUTES
        Route::get('/members/academic/official', [AcademicMembersController::class, 'index'])->name('academicmember.index');
        Route::post('/members/academic/official', [AcademicMembersController::class, 'store'])->name('academicmember.store');
        Route::get('/members/academic/official/create', [AcademicMembersController::class, 'create'])->name('academicmember.create');
        Route::put('/members/academic/official/{member}/{orgId}', [AcademicMembersController::class, 'update'])->name('academicmember.update');
        Route::get('/members/academic/official/{member}/{orgId}', [AcademicMembersController::class, 'show'])->name('academicmember.show');
        Route::get('/members/academic/official/{member}/edit/{orgId}', [AcademicMembersController::class, 'edit'])->name('academicmember.edit');

        Route::post('/members/academic/message/{member}',[ AcademicMembersController::class, 'messageMember'])->name('academicmessage-member');
        Route::get('/members/academic/filter' , [AcademicMembersController::class, 'filterMembers'])->name('academicmember-filter');

        //ACADEMIC APPLICATIONS CONTROLLER ROUTES
        Route::get('/members/academic/applications/expected-registrants', [AcademicApplicationController::class, 'expectedRegistrants'])->name('academicapplication.registrants');
        Route::post('/members/academic/applications/expected-registrants',[AcademicApplicationController::class, 'addNewRegistrant'])->name('academicapplication-addnewregistrant');
        Route::get('/members/academic/applications', [AcademicApplicationController::class, 'index'])->name('academicapplication.index');
        Route::put('/members/academic/application/accept/{application}/{orgId}', [AcademicApplicationController::class, 'accept'])->name('academicapplication.accept');
        Route::put('/members/academic/application/decline/{application}/{orgId}', [AcademicApplicationController::class, 'decline'])->name('academicapplication.decline');
        
        //ACADEMIC MEMBERSHIP CONTROLLER ROUTES
        Route::get('/academicmembership', [AcademicMembershipController::class, 'index'])->name('academicmembership.index');
        Route::post('/academicmembership', [AcademicMembershipController::class, 'store'])->name('academicmembership.store');
        Route::get('/academicmembership/create', [AcademicMembershipController::class, 'create'])->name('academicmembership.create');
        Route::put('/academicmembership/{academicmembership}/{orgId}', [AcademicMembershipController::class, 'update'])->name('academicmembership.update');
        Route::get('/academicmembership/{academicmembership}/{orgId}', [AcademicMembershipController::class, 'show'])->name('academicmembership.show');
        Route::get('/academicmembership/{academicmembership}/edit/{orgId}', [AcademicMembershipController::class, 'edit'])->name('academicmembership.edit');

        //NON ACADEMIC MEMBERSHIP CONTROLLER ROUTES
        Route::get('/nonacademicmembership', [NonAcademicMembershipController::class, 'index'])->name('nonacademicmembership.index');
        Route::post('/nonacademicmembership', [NonAcademicMembershipController::class, 'store'])->name('nonacademicmembership.store');
        Route::get('/nonacademicmembership/create', [NonAcademicMembershipController::class, 'create'])->name('nonacademicmembership.create');
        Route::put('/nonacademicmembership/{payment}/{orgId}', [NonAcademicMembershipController::class, 'update'])->name('nonacademicmembership.update');
        Route::get('/nonacademicmembership/{payment}/{orgId}', [NonAcademicMembershipController::class, 'show'])->name('nonacademicmembership.show');
        Route::get('/nonacademicmembership/{payment}/edit/{orgId}', [NonAcademicMembershipController::class, 'edit'])->name('nonacademicmembership.edit');

    });
     
    //users routes
    Route::prefix('user')->middleware(['auth','auth.isStudent'])->name('user.')->group(function () {

          //USER ACADEMIC CONTROLLERS ROUTES
        Route::prefix('academic')->name('academic.')->group(function () {
            
            Route::get('application-form', [UserAcademicApplicationsController::class, 'showForm'])->name('academic-application');
            Route::post('application',[UserAcademicApplicationsController::class, 'store'])->name('application-store');
            Route::get('messages', [AcademicMessagesController::class, 'index'])->name('messages');
            Route::get('my-organizations', [UserOrganizationsController::class, 'index'])->name('my-organizations');
            Route::get('my-applications', [UserApplicationsController::class, 'index'])->name('my-applications');
            Route::post('my-applications', [UserApplicationsController::class, 'store'])->name('apply');
        });
          //USER NON ACADEMIC CONTROLLERS ROUTES
        Route::prefix('nonacademic')->name('nonacademic.')->group(function () {
            
            Route::get('application-form', [UserNonacademicApplicationController::class, 'showForm'])->name('nonacademic-application');

        });
    });    
});
