<?php

use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\attendance\AttendanceController;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\NewPasswordController;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\department\DepartmentController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\homepage\HomePagesController;
use App\Http\Controllers\job_posting\JobController;
use App\Http\Controllers\leave\LeaveController;
use App\Http\Controllers\logs\LogsController;
use App\Http\Controllers\message\MessageController;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscTooManyRequest;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\payroll\PayrollController;
use App\Http\Controllers\profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePagesController::class, 'home'])->name('home-page');
Route::get('/about', [HomePagesController::class, 'about'])->name('about-page');

Route::get('/job', [HomePagesController::class, 'services'])->name('job-page');
Route::get('/job/{id}', [HomePagesController::class, 'viewJob'])->name('job-details');
Route::get('/job/form/{id}', [HomePagesController::class, 'jobForm'])->name('job-form');
Route::post('/job/form/add', [HomePagesController::class, 'application'])->name('job-form-add');
Route::get('/job/message/{email}', [HomePagesController::class, 'message'])->name('job-form-message');

Route::get('/contact', [HomePagesController::class, 'contact'])->name('contact-page');

Route::middleware(['guest', 'throttle:web'])->group(function () {
  Route::get('/login', [LoginBasic::class, 'index'])->name('login');
  Route::post('/login/process', [LoginBasic::class, 'login'])->name('login-process')->middleware(['throttle:login']);

  Route::get('/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password');
  Route::get('/forgot-password/otp/{id}', [ForgotPasswordBasic::class, 'viewOTP'])->name('auth-request-otp');
  Route::post('/forgot-password/process', [ForgotPasswordBasic::class, 'sendOTP'])->name('auth-send-otp');
  Route::post('/forgot-password/verify', [ForgotPasswordBasic::class, 'verifyOTP'])->name('auth-verify-otp');

  Route::get('/new-password/{id}', [NewPasswordController::class, 'index'])->name('new-password');
  Route::post('/new-password/process', [NewPasswordController::class, 'newAccount'])->name('new-password-process');

});

Route::middleware(['auth', 'role:Admin,Employee,Hr,Manager', 'throttle:web'])->group(function () {
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
  Route::get('/profile', [ProfileController::class, 'EmployeeProfile'])->name('profile-employee');
  Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile-index');
  Route::post('/profile/experience/add', [ProfileController::class, 'addExperience'])->name('profile-experience-add');
  Route::post('/profile/experience/delete', [ProfileController::class, 'deleteExperience'])->name('profile-experience-delete');
  Route::post('/profile/experience/update', [ProfileController::class, 'updateExperience'])->name('profile-experience-update');
  Route::get('/department/profile/{id}', [ProfileController::class, 'profileDepartment'])->name('department-profile-index');

  Route::get('/attendance/user', [AttendanceController::class, 'userAttendance'])->name('attendance-user');
  Route::get('/attendance/face-recognation', [AttendanceController::class, 'faceRecognation'])->name('attendance-check');
  Route::get('/employee-data', [AttendanceController::class, 'employeeData'])->name('employee-data-fetch');
  Route::get('/attendance/check', [AttendanceController::class, 'attendace'])->name('attendace-check-processing');
  Route::get('/attendance/data', [AttendanceController::class, 'getAttendance'])->name('attendance-display');
  Route::get('/attendance/todays-date', [AttendanceController::class, 'fetchTodayData'])->name('todays-data');
  Route::get('/attendance/employee-dtr', [AttendanceController::class, 'employeeAttendance'])->name('attendance-employee');

  Route::get('/department/list', [DepartmentController::class, 'index'])->name('department-list');

  Route::get('/department/{id}', [DepartmentController::class, 'details'])->name('department-details');
  Route::post('/department/addEmployee', [DepartmentController::class, 'addEmployee'])->name('department-add-employee');
  Route::post('/department/remove', [DepartmentController::class, 'removeEmployee'])->name('departmane-remove-employee');
  Route::post('/department/manager/add', [DepartmentController::class, 'addManager'])->name('department-manager-add');

  Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
  Route::middleware(['role:Admin'])->group(function () {
    Route::get('/logs', [LogsController::class, 'index'])->name('logs');
  });

   Route::middleware(['role:Admin,Hr,Manager'])->group(function () {
    Route::get('/dtr-report', [AttendanceController::class, 'viewEmployee'])->name('dtr-report');
    Route::post('/dtr-report/view', [AttendanceController::class, 'preview'])->name('dtr-report-preview');

  });

  Route::middleware(['role:Admin,Hr'])->group(function () {

    Route::get('/user', [UserController::class, 'index'])->name('user-accounts');
    Route::post('/user/add', [UserController::class, 'store'])->name('user-add');
    Route::post('/user/update', [UserController::class, 'update'])->name('user-update');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('user-delete');

    Route::get('/employee/face-registration/{id}', [EmployeeController::class, 'registerFace'])->name('employee-faceRegistration');
    Route::post('/employee/face-registration/add', [EmployeeController::class, 'registerFaceProcess'])->name('employyee-registerFace-process');
    Route::post('/employee/face-registration/reset', [EmployeeController::class, 'resetFaceID'])->name('employyee-registerFace-reset');

    Route::post('/message/applicant/sent', [MessageController::class, 'applicantMail'])->name('message-applicant-sent');
    Route::post('/message/sent', [MessageController::class, 'sendMessage'])->name('message-sent');
    Route::post('/message-broadcast/sent', [MessageController::class, 'broadcastMessage'])->name('broadcast-sent');
    Route::post('/message-broadcast-department/sent', [MessageController::class, 'broadcastMessageDepartment'])->name('broadcast-department-sent');

    Route::get('/job_posting', [JobController::class, 'jobPosting'])->name('job-posting');
    Route::post('/job_posting/add', [JobController::class, 'addJob'])->name('job-posting-add');
    Route::get('/job_posting/{id}', [JobController::class, 'viewJob'])->name('job-posting-view');
    Route::get('/job_posting/applicants/{id}', [JobController::class, 'jobApplicants'])->name('job-posting-applicants');
    Route::post('/job_posting/applicants/accept', [JobController::class, 'applicationAccepted'])->name('job-posting-applicants-accept');
    Route::post('/job_posting/applicants/reject', [JobController::class, 'applicationRejected'])->name('job-posting-applicants-rejected');
    Route::post('/job_posting/applicants/shortlist', [JobController::class, 'applicationShorlist'])->name('job-posting-applicants-shortlist');
    Route::post('/job_posting/applicants/assessment', [JobController::class, 'assessment'])->name('job-posting-applicants-assessment');
    Route::post('/job_posting/applicants/feedback', [JobController::class, 'applicantFeedback'])->name('job-posting-applicants-feedback');
    Route::post('/job_posting/open', [JobController::class, 'openJob'])->name('job-posting-open');
    Route::post('/job_posting/close', [JobController::class, 'closeJob'])->name('job-posting-close');
    Route::post('/job_posting/delete', [JobController::class, 'deteleJob'])->name('job-posting-delete');
    Route::post('/job_posting/update', [JobController::class, 'updateJob'])->name('job-posting-update');

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::post('/employee/edit', [EmployeeController::class, 'editEmployee'])->name('employee-edit');
    Route::post('/employee/add', [EmployeeController::class, 'addEmployee'])->name('employee-add');
    Route::post('/employee/remove', [EmployeeController::class, 'removeEmployee'])->name('employee-remove');
    Route::post('/employee/details-update', [EmployeeController::class, 'employeeRaise'])->name('employee-details-update');

    Route::get('/attendance/dashboard', [AttendanceController::class, 'index'])->name('attendance-index');
    Route::get('/attendance/employee/{id}', [AttendanceController::class, 'getAttendanceEmployee'])->name('attendance-employee-display');
    Route::get('/attendance/employee-dtr/{id}', [AttendanceController::class, 'employeeAttendanceView'])->name('attendance-employee-view');

    Route::post('/department/add', [DepartmentController::class, 'addDepartment'])->name('department-add');
    Route::post('/department/edit', [DepartmentController::class, 'editDepartment'])->name('department-edit');
    Route::post('/department/delete', [DepartmentController::class, 'deleteDepartment'])->name('department-delete');
  });
});

Route::get('/logout', [LoginBasic::class, 'logoutAccount'])->name('logout-process')->middleware(['throttle:web']);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');
Route::get('/pages/misc-too-many-request', [MiscTooManyRequest::class, 'index'])->name('pages-misc-too-many-request');