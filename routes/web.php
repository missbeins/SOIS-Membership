<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Academic\AcademicMembersController;
use App\Http\Controllers\Admin\Academic\AcademicPaymentsController;
use App\Http\Controllers\Admin\Academic\AcademicApplicationController;
use App\Http\Controllers\Admin\Academic\MessageController;
use App\Http\Controllers\Admin\Membership\Academic\AcademicMembershipController;
use App\Http\Controllers\Admin\Membership\Nonacademic\NonacademicMembershipController;

use App\Http\Controllers\User\Academic\UserOrganizationsController;
use App\Http\Controllers\User\Academic\UserApplicationsController;
use App\Http\Controllers\User\Academic\UserAcademicApplicationsController;
use App\Http\Controllers\User\Academic\AcademicMessagesController;

use App\Http\Controllers\User\Nonacademic\UserNonacademicApplicationController;

use App\Http\Controllers\InformationVerificationController;
use App\Http\Controllers\User\UpdateProfileController;
use App\Http\Controllers\User\UserProfileController;

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
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/import', [UserController::class, 'importStudents'])->name('expectedstudent-import');

        //ACADEMIC PAYMENTS CONTROLLER ROUTES
        Route::get('/members/academic/payments/filter', [AcademicPaymentsController::class, 'filterPayments'])->name('academicfilterPayment');
        Route::get('/members/academic/payments', [AcademicPaymentsController::class, 'index'])->name('academicpayment.index');
        Route::get('/members/academic/payments/{payment}/{orgId}', [AcademicPaymentsController::class, 'show'])->name('academicpayment.show');

        //ACADEMIC MEMBERS CONTROLLER ROUTES
        Route::get('/members/academic/official', [AcademicMembersController::class, 'index'])->name('academicmember.index');
        Route::get('/members/academic/official/{member}/{orgId}', [AcademicMembersController::class, 'show'])->name('academicmember.show');
        Route::post('/members/academic/message/{member}',[ AcademicMembersController::class, 'messageMember'])->name('academicmessage-member');
        Route::get('/members/academic/filter' , [AcademicMembersController::class, 'filterMembers'])->name('academicmember-filter');

        //ACADEMIC APPLICATIONS CONTROLLER ROUTES
        Route::get('/members/academic/applications/expected-registrants', [AcademicApplicationController::class, 'expectedRegistrants'])->name('academicapplication.registrants');
        Route::post('/members/academic/applications/expected-registrants',[AcademicApplicationController::class, 'addNewRegistrant'])->name('academicapplication-addnewregistrant');
        Route::get('/members/academic/applications', [AcademicApplicationController::class, 'index'])->name('academicapplication.index');
        Route::put('/members/academic/application/accept/{application}/{orgId}', [AcademicApplicationController::class, 'accept'])->name('academicapplication.accept');
        Route::put('/members/academic/application/decline/{application}/{orgId}', [AcademicApplicationController::class, 'decline'])->name('academicapplication.decline');
        Route::get('/members/academic/applications/declined-applications', [AcademicApplicationController::class, 'declinedApplications'])->name('academicapplication.declinedApplications');

        //ACADEMIC MEMBERSHIP CONTROLLER ROUTES
        Route::get('/academicmembership', [AcademicMembershipController::class, 'index'])->name('academicmembership.index');
        Route::post('/academicmembership', [AcademicMembershipController::class, 'store'])->name('academicmembership.store');
        Route::get('/academicmembership/create', [AcademicMembershipController::class, 'create'])->name('academicmembership.create');
        Route::put('/academicmembership/{academicmembership}/{orgId}', [AcademicMembershipController::class, 'update'])->name('academicmembership.update');
        Route::get('/academicmembership/{academicmembership}/edit/{orgId}', [AcademicMembershipController::class, 'edit'])->name('academicmembership.edit');
        
        //ACADEMIC MESSAGES
        Route::get('messages/inbox', [MessageController::class, 'inbox'])->name('academic.inbox');
        Route::get('messages/sent', [MessageController::class, 'sent'])->name('academic.sent');
        Route::post('messages/reply/{message}', [MessageController::class, 'reply'])->name('academic.reply');

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
            Route::get('messages/inbox', [AcademicMessagesController::class, 'index'])->name('messages');
            Route::get('messages/sent', [AcademicMessagesController::class, 'sent'])->name('sent');
            Route::get('my-organizations', [UserOrganizationsController::class, 'index'])->name('my-organizations');
            Route::get('my-applications', [UserApplicationsController::class, 'index'])->name('my-applications');
            Route::post('my-applications', [UserApplicationsController::class, 'store'])->name('apply');
            Route::post('messages/reply/{message}',[AcademicMessagesController::class, 'replyMessage'])->name('reply');
            Route::delete('messages/delete/{message}',[AcademicMessagesController::class, 'deleteMessage'])->name('delete');
        });

          //USER NON ACADEMIC CONTROLLERS ROUTES
        Route::prefix('nonacademic')->name('nonacademic.')->group(function () {
            
            Route::get('application-form', [UserNonacademicApplicationController::class, 'showForm'])->name('nonacademic-application');

        });
        Route::get('profile', UserProfileController::class)->name('profile');
        Route::put('profile/update/{user}', [UpdateProfileController::class, 'updateProfile'])->name('update-profile');


    });    
});
