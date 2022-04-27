<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Academic\AcademicMembersController;
use App\Http\Controllers\Admin\Academic\AcademicPaymentsController;
use App\Http\Controllers\Admin\Academic\AcademicApplicationController;
use App\Http\Controllers\Admin\Academic\MessageController;
use App\Http\Controllers\Admin\Membership\Academic\AcademicMembershipController;
use App\Http\Controllers\Admin\Membership\Academic\AcademicReportsController;
use App\Http\Controllers\Admin\Membership\Nonacademic\NonAcademicMembershipController;
use App\Http\Controllers\Admin\Membership\Nonacademic\NonacademicReportsController;
use App\Http\Controllers\Admin\Nonacademic\NonAcademicApplicationsController;
use App\Http\Controllers\Admin\Nonacademic\NonAcademicMembersController;
use App\Http\Controllers\Admin\Nonacademic\NonAcademicPaymentsController;
use App\Http\Controllers\Admin\Nonacademic\NonAcademicMessagesController;

use App\Http\Controllers\User\Academic\UserOrganizationsController;
use App\Http\Controllers\User\Academic\UserApplicationsController;
use App\Http\Controllers\User\Academic\UserAcademicApplicationsController;
use App\Http\Controllers\User\Academic\AcademicMessagesController;

use App\Http\Controllers\User\Nonacademic\UserNonAcademicApplicationController;

use App\Http\Controllers\InformationVerificationController;
use App\Http\Controllers\User\Nonacademic\NonAcadsUserApplicationsController;
use App\Http\Controllers\User\Nonacademic\UserNonAcadsOrgsController;
use App\Http\Controllers\User\UpdateProfileController;
use App\Http\Controllers\User\UserProfileController;

use App\Http\Controllers\StudentsServices\SSProfileController;
use App\Http\Controllers\StudentsServices\SSUpdateProfileController;
use App\Http\Controllers\StudentsServices\StudentServicesController;

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

Route::get('/sois-membership/initializeStorageLink/', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    return redirect()->route('membership.admin.academic.users.index');
})->middleware('auth');
// Route for SOIS-Homepage Redirect
Route::get('/$0lsL0gIn/idem/{id}/gateportal/{key}', [App\Http\Controllers\AutoLoginController::class, 'login']);

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
        Route::prefix('academic')->name('academic.')->group(function () {

            //USER CONTROLLER ROUTES ONLY FOR ACADEMIC ORGANIZATIONS           
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
            Route::get('memberships',[AcademicReportsController::class, 'index'])->name('memberships-reports');
            Route::get('memberships/details/{membership}',[AcademicReportsController::class, 'showMembershipDetails'])->name('memberships-details');
            Route::get('memberships/members/{membership}',[AcademicReportsController::class, 'showMembers'])->name('memberships-members');
            Route::get('memberships/members/show-details/{member}',[AcademicReportsController::class, 'showMembersDetails'])->name('members-details');
            Route::get('memberships/generate-pdf/{membership}',[AcademicReportsController::class, 'generateAcadMembershipPDF'])->name('generateAcadMembershipPDF');
            Route::post('memberships/generate-pdf/per-year-level',[AcademicReportsController::class, 'generateAcadMembershipPDFperYearLevel'])->name('generateAcadMembershipPDFperYearLevel');
       



            //ACADEMIC MESSAGES
            Route::get('messages/inbox', [MessageController::class, 'inbox'])->name('inbox');
            Route::get('messages/sent', [MessageController::class, 'sent'])->name('sent');
            Route::post('messages/reply/{message}', [MessageController::class, 'reply'])->name('reply');
            Route::put('messages/read/message/{message}', [MessageController::class, 'readMessage'])->name('read-message');
            Route::put('messages/read/reply/{message}', [MessageController::class, 'readReply'])->name('read-reply');
            Route::post('messages/sent/new-message', [MessageController::class, 'showMassMessage'])->name('show-massMessageForm');
            Route::post('messages/sent/send/all-members', [MessageController::class, 'massMessageAllMembers'])->name('massMessage-allmembers');
            Route::post('messages/sent/send/by-year-level', [MessageController::class, 'massMessageByYearLevel'])->name('massMessage-yearlevel');


        });
        Route::prefix('nonacademic')->middleware('auth')->name('nonacademic.')->group(function () {

            //NON ACADEMIC MEMBERSHIP CONTROLLER ROUTES
            Route::get('/nonacademicmembership', [NonAcademicMembershipController::class, 'index'])->name('nonacademicmembership.index');
            Route::post('/nonacademicmembership', [NonAcademicMembershipController::class, 'store'])->name('nonacademicmembership.store');
            Route::put('/nonacademicmembership/{nonacadsmembership}/{orgId}', [NonAcademicMembershipController::class, 'update'])->name('nonacademicmembership.update');
            Route::get('/nonacademicmembership/{nonacadsmembership}/{orgId}', [NonAcademicMembershipController::class, 'show'])->name('nonacademicmembership.show');
            Route::get('/nonacademicmembership/{noncadsmembership}/edit/{orgId}', [NonAcademicMembershipController::class, 'edit'])->name('nonacademicmembership.edit');
            Route::get('memberships',[NonacademicReportsController::class, 'index'])->name('memberships-reports');
            Route::get('memberships/details/{membership}',[NonacademicReportsController::class, 'showMembershipDetails'])->name('memberships-details');
            Route::get('memberships/members/{membership}',[NonacademicReportsController::class, 'showMembers'])->name('memberships-members');
            Route::get('memberships/members/show-details/{member}',[NonacademicReportsController::class, 'showMembersDetails'])->name('members-details');
            Route::get('memberships/generate-pdf/{membership}',[NonacademicReportsController::class, 'generateNonAcadMembershipPDF'])->name('generateNonAcadMembershipPDF');
            Route::post('memberships/generate-pdf/per-year-level',[NonacademicReportsController::class, 'generateNonAcadMembershipPDFperYearLevel'])->name('generateNonAcadMembershipPDFperYearLevel');
       

            
            //NON ACADEMIC APPLICATIONS CONTROLLER ROUTES
            Route::get('/applications', [NonAcademicApplicationsController::class, 'index'])->name('nonacademicapplication.index');
            Route::put('/application/accept/{application}/{orgId}', [NonAcademicApplicationsController::class, 'accept'])->name('nonacademicapplication.accept');
            Route::put('/application/decline/{application}/{orgId}', [NonAcademicApplicationsController::class, 'decline'])->name('nonacademicapplication.decline');
            Route::get('/applications/declined-applications', [NonAcademicApplicationsController::class, 'declinedApplications'])->name('nonacademicapplication.declinedApplications');
            
            //NON ACADEMIC MEMBERS CONTROLLER ROUTES
            Route::get('/members/official', [NonAcademicMembersController::class, 'index'])->name('nonacademicmember.index');
            Route::get('/members/official/{member}/{orgId}', [NonAcademicMembersController::class, 'show'])->name('nonacademicmember.show');
            Route::post('/members/message/{member}',[ NonAcademicMembersController::class, 'messageMember'])->name('nonacademicmessage-member');
            Route::get('/members/filter' , [NonAcademicMembersController::class, 'filterMembers'])->name('nonacademicmember-filter');

            //NON ACADEMIC PAYMENTS CONTROLLER ROUTES
            Route::get('/members/payments/filter', [NonAcademicPaymentsController::class, 'filterPayments'])->name('nonacademicfilterPayment');
            Route::get('/members/payments', [NonAcademicPaymentsController::class, 'index'])->name('nonacademicpayment.index');
            Route::get('/members/payments/{payment}/{orgId}', [NonAcademicPaymentsController::class, 'show'])->name('nonacademicpayment.show');
            
            //NON ACADEMIC MESSAGES
            Route::get('messages/inbox', [NonAcademicMessagesController::class, 'inbox'])->name('inbox');
            Route::get('messages/sent', [NonAcademicMessagesController::class, 'sent'])->name('sent');
            Route::post('messages/reply/{message}', [NonAcademicMessagesController::class, 'reply'])->name('reply');
            Route::put('messages/read/message/{message}', [NonAcademicMessagesController::class, 'readMessage'])->name('read-message');
            Route::put('messages/read/reply/{message}', [NonAcademicMessagesController::class, 'readReply'])->name('read-reply');
            Route::post('messages/sent/new-message', [NonAcademicMessagesController::class, 'showMassMessage'])->name('show-massMessageForm');
            Route::post('messages/sent/send/all-members', [NonAcademicMessagesController::class, 'massMessageAllMembers'])->name('massMessage-allmembers');
            Route::post('messages/sent/send/by-year-level', [NonAcademicMessagesController::class, 'massMessageByYearLevel'])->name('massMessage-yearlevel');

        });
    });
     
    //users routes
    Route::prefix('user')->middleware(['auth','auth.isStudent'])->name('user.')->group(function () {

          //USER ACADEMIC CONTROLLERS ROUTES
        Route::prefix('academic')->name('academic.')->group(function () {
            
            Route::get('application-form', [UserAcademicApplicationsController::class, 'showForm'])->name('academic-application');
            Route::post('applications',[UserAcademicApplicationsController::class, 'store'])->name('application-store');
            Route::get('messages/inbox', [AcademicMessagesController::class, 'index'])->name('messages');
            Route::get('messages/sent', [AcademicMessagesController::class, 'sent'])->name('sent');
            Route::get('my-organizations', [UserOrganizationsController::class, 'index'])->name('my-organizations');
            Route::get('my-applications', [UserApplicationsController::class, 'index'])->name('my-applications');
            Route::post('my-applications', [UserApplicationsController::class, 'store'])->name('apply');
            Route::post('messages/reply/{message}',[AcademicMessagesController::class, 'replyMessage'])->name('reply');
            Route::put('messages/read/message/{message}',[AcademicMessagesController::class, 'readMessage'])->name('read-message');
            Route::put('messages/read/reply/{message}',[AcademicMessagesController::class, 'readReply'])->name('read-reply');


            // Route::delete('messages/delete/{message}',[AcademicMessagesController::class, 'deleteMessage'])->name('delete');
        });

          //USER NON ACADEMIC CONTROLLERS ROUTES
        Route::prefix('nonacademic')->name('nonacademic.')->group(function () {
         
            Route::get('my-applications', [NonAcadsUserApplicationsController::class, 'index'])->name('my-applications');
            Route::get('application-form', [UserNonacademicApplicationController::class, 'showForm'])->name('nonacademic-application');
            Route::post('applications',[UserNonacademicApplicationController::class, 'store'])->name('application-store');
            Route::get('my-organizations', [UserNonAcadsOrgsController::class, 'index'])->name('my-organizations');
            Route::get('my-applications', [NonAcadsUserApplicationsController::class, 'index'])->name('my-applications');
            // Route::get('messages/inbox', [UserNonAcademicMessagesController::class, 'index'])->name('messages');
            // Route::get('messages/sent', [UserNonAcademicMessagesController::class, 'sent'])->name('sent');
            // Route::post('messages/reply/{message}',[UserNonAcademicMessagesController::class, 'replyMessage'])->name('reply');
            
            // Route::delete('messages/delete/{message}',[AcademicMessagesController::class, 'deleteMessage'])->name('delete');
        
        });
        Route::get('profile', UserProfileController::class)->name('profile');
        Route::put('profile/update/{user}', [UpdateProfileController::class, 'updateProfile'])->name('update-profile');


    }); 
    
    // student affairs routes
    Route::prefix('student-services')->name('student-services.')->group(function (){
        Route::get('profile', SSProfileController::class)->name('profile');
        Route::put('profile/update/{user}', [SSUpdateProfileController::class, 'updateProfile'])->name('update-profile');
        Route::get('organizations/academic-organizations', [StudentServicesController::class, 'academicOrgs'])->name('academicOrgs');
        Route::get('organizations/nonacademic-organizations', [StudentServicesController::class, 'nonacademicOrgs'])->name('nonacademicOrgs');
        Route::get('organizations/academic-organizations/memberships/{organization}', [StudentServicesController::class, 'acadOrgsMemberships'])->name('acadOrgsMemberships');
        Route::get('organizations/nonacademic-organizations/memberships/{organization}', [StudentServicesController::class, 'nonacadOrgsMemberships'])->name('nonacadOrgsMemberships');
        Route::get('organizations/academic-organizations/memberships/details/{membership}', [StudentServicesController::class, 'showAcadsMembershipDetails'])->name('showAcadsMembershipDetails');
        Route::get('organizations/nonacademic-organizations/memberships/details/{membership}', [StudentServicesController::class, 'showNonacadsMembershipDetails'])->name('showNonacadsMembershipDetails');
        Route::get('organizations/academic-organizations/memberships/member-details/{member}', [StudentServicesController::class, 'showAcadMemberDetails'])->name('showAcadMemberDetails');
        Route::get('organizations/nonacademic-organizations/memberships/member-details/{member}', [StudentServicesController::class, 'showNonacadMemberDetails'])->name('showNonacadMemberDetails');
        Route::post('organizations/academic-organizations/memberships/generate-pdf',[StudentServicesController::class, 'generateAcadMembershipPDF'])->name('generateAcadMembershipPDF');
        Route::post('organizations/academic-organizations/memberships/generate-pdf/per-year-level',[StudentServicesController::class, 'generateAcadMembershipPDFperYearLevel'])->name('generateAcadMembershipPDFperYearLevel');
        Route::post('organizations/nonacademic-organizations/memberships/generate-pdf',[StudentServicesController::class, 'generateNonacadMembershipPDF'])->name('generateNonacadMembershipPDF');

    });
});
