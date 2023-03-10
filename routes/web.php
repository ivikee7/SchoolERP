<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EnquiryPublicController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Gsuite;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LeaveManagementController;
use App\Http\Controllers\UserPermissionsController;
use App\Models\PublicEnquiry;
use App\Models\UserInformation;

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

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Public Enquiry
Route::get('/public/enquiry', function () {
    return view('public.enquiry.enquiry');
})->name('public.enquiry');
// Route::post('/public/enquiry', [EnquiryController::class, 'publicStore'])->name('public.enquiry.store');

// Auth Check
Route::group(['middleware' => ['auth']], function () {

    // Role & Permission
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('user_permission', UserPermissionsController::class);
    Route::get('/user_permission_assign/data', [UserPermissionsController::class, 'userSearchForPermissionAssign']);

    // General Access
    Route::get('/', [HomeController::class, 'home'])->name('index');

    // Profile
    Route::get('profile', [UserController::class, 'profile'])->name('profile');

    // User
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update');
        // Information
        Route::post('/information/{id}', [UserController::class, 'informationUpdate'])->name('user.information.update');
    });

    Route::prefix('/image')->group(function () {
        Route::get('/{id}', [ImageController::class, 'index'])->name('image.index');
        Route::post('/{id}', [ImageController::class, 'update'])->name('image.update');
    });

    // Student
    Route::prefix('/student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('student.index');
        Route::get('/create', [StudentController::class, 'create'])->name('student.create');
        Route::post('/', [StudentController::class, 'store'])->name('student.store');
        Route::get('/{id}', [StudentController::class, 'show'])->name('student.show');
        Route::put('/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::get('/list/class/wise', [StudentController::class, 'classStudents'])->name('student.class.students');
    });

    // Admission
    Route::prefix('/student/admission')->group(function () {
        Route::put('{id}', [AdmissionController::class, 'update'])->name('admission.update');
        Route::get('trashed', [AdmissionController::class, 'trashed'])->name('admission.trashed.index');
    });

    // Change class section
    Route::prefix('/student/class')->group(function () {
        Route::get('/section/change', [StudentController::class, 'changeClassSectionEdit'])->name('student.change.class.section.edit');
        Route::post('/section/change', [StudentController::class, 'changeClassSectionUpdate'])->name('student.change.class.section.update');
        Route::get('/change', [StudentController::class, 'getStudentsAjaxCall'])->name('student.change.class.section.ajax.students');
        Route::get('/strength', [StudentController::class, 'getClassStudentsStrengthAjaxCall'])->name('class.student.strength.ajax');
    });

    // Enquiry
    Route::prefix('/student/admission/enquiry')->group(function () {
        Route::get('/', [EnquiryController::class, 'index'])->name('enquiry.index');
        Route::get('create', [EnquiryController::class, 'create'])->name('enquiry.create');
        Route::post('/', [EnquiryController::class, 'store'])->name('enquiry.store');
        Route::delete('{id}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');
        Route::get('trashed', [EnquiryController::class, 'trashed'])->name('enquiry.trashed.index');
    });

    // Website
    Route::prefix('/website')->group(function () {
        Route::get('/enquiry', [EnquiryPublicController::class, 'index'])->name('website.enquiry.index');
    });

    // Registration
    Route::prefix('/student/admission/registration')->group(function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('registration.index');
        Route::get('create', [RegistrationController::class, 'create'])->name('registration.create');
        Route::post('/', [RegistrationController::class, 'store'])->name('registration.store');
        Route::delete('{id}', [RegistrationController::class, 'destroy'])->name('registration.destroy');
        Route::get('trashed', [RegistrationController::class, 'trashed'])->name('registration.trashed.index');
        Route::get('{id}', [RegistrationController::class, 'restore'])->name('registration.restore');
    });

    // Attendance
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('user.attendance.index');
        Route::post('/', [AttendanceController::class, 'store'])->name('user.attendance.store');
        // Report
        Route::get('/report/daily', [AttendanceController::class, 'daily'])->name('user.attendance.report.daily');
        Route::get('/report/monthly', [AttendanceController::class, 'monthly'])->name('user.attendance.report.monthly');
    });

    // Leave Management
    Route::prefix('attendance/leave-management/leave')->group(function () {
        Route::get('/', [LeaveManagementController::class, 'index'])->name('user.attendance.leave.management.index');
        // Create
        Route::get('/create', [LeaveManagementController::class, 'create'])->name('user.attendance.leave.management.create');
        Route::post('/create', [LeaveManagementController::class, 'store'])->name('user.attendance.leave.management.store');
        // Approval
        Route::get('/edit', [LeaveManagementController::class, 'edit'])->name('user.attendance.leave.management.edit');
        Route::get('/edit/{id}/accept', [LeaveManagementController::class, 'accept'])->name('user.attendance.leave.management.accept');
        Route::get('/edit/{id}/reject', [LeaveManagementController::class, 'reject'])->name('user.attendance.leave.management.reject');
        Route::get('/edit/{id}/destroy', [LeaveManagementController::class, 'destroy'])->name('user.attendance.leave.management.destroy');
        // Report
        Route::get('/report/daily', [LeaveManagementController::class, 'daily'])->name('user.attendance.leave.management.report.daily');
        Route::get('/report/monthly', [LeaveManagementController::class, 'monthly'])->name('user.attendance.leave.management.report.monthly');
    });

    // G-Suite
    Route::prefix('/g-suite')->group(function () {
        Route::get('/users/create', [Gsuite::class, 'usersCreateIndex'])->name('gsuite.users.create.index');
        Route::get('/users/update', [Gsuite::class, 'usersUpdateIndex'])->name('gsuite.users.update.index');
    });
});
