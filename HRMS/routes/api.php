<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\LeaveRequestsController;
use App\Http\Controllers\LeaveTypesController;
use App\Http\Controllers\TrainingSessionsController;
use App\Http\Controllers\EmployeeTrainingsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RolesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(RolesController::class)->group(function () {
    Route::get('/roles', 'index')->name('roles.index');
    Route::post('/roles', 'store');
    Route::put('/roles/{roles}', 'update');
    Route::delete('/roles/{roles}', 'destroy');
});

Route::controller(DocumentsController::class)->group(function () {
    Route::post("documentstore","store");
Route::get("documentindex","index");
Route::put("documentupdate/{documents}","update");
Route::delete("documentdelete/{documents}","destroy");
});
Route::controller(SalariesController::class)->group(function () {
    Route::post('Salariesstore','store')->name("salaries.store");
    Route::get('Salariesindex','index')->name("salaries.index");
    Route::get('Salariescreate','create')->name("salaries.create");
    Route::put('/Salariesupdate/{salaries}','update');
    Route::delete('/Salariesdelete/{salaries}','destroy');

   // Route::get('/salaries/{salaries}/edit', [SalariesController::class, 'edit'])->name('salaries.edit');

    });


Route::controller(AuthController::class)->group(function () {
    Route::post('/login','login');
    Route::post('register','register')->name("register.user");
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::get('/index','index')->name('index');

    });

Route::controller(AttendanceController::class)->group(function () {
    Route::get('Attendanceindex','index');
    Route::get('Attendancecreate','create');
    Route::post('Attendancestore','store');
    Route::put('/Attendanceupdate/{attendance}','update');
    Route::delete('/Attendancedelete/{attendance}','destroy');
});    
Route::controller(DepartmentsController::class)->group(function () {
Route::get('Departmentsindex','index')->name('departments.index');
Route::get('Departmentscreate','getEmployeeById')->name('departments.create');
Route::post('Departmentsstore','store');
Route::put('/Departmentsupdate/{departments}','update');
Route::delete('/Departmentsdelete/{departments}','destroy');
});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('Employeesindex','index')->name('Employees.index');
    Route::get('Employeescreate','create')->name('Employees.create');
    Route::post('Employeesstore','store');
    Route::put('/Employeesupdate/{employee}','update');
Route::delete('/Employeesdelete/{employee}','destroy');
    });


Route::controller(LeaveRequestsController::class)->group(function () {
   Route::get('Leaveindex','index');
   Route::post('Leavestore','store'); 
   Route::delete('/Leavedelete/{leaveRequests}','destroy');
   Route::put('/Leaveupdate/{leaveRequests}','update');
});    
    
    
Route::controller(LeaveTypesController::class)->group(function () {
    Route::get('Leavetypeindex','index');
    Route::post('Leavetypestore','store'); 
    Route::delete('/Leavetypedelete/{leaveTypes}','destroy');
    Route::put('/Leavetypeupdate/{leaveTypes}','update');
 });   

 Route::controller(TrainingSessionsController::class)->group(function () {
    Route::post('Trainingstore','store'); 
    Route::get('Trainingindex','index');
    Route::delete('/Trainingdelete/{trainingSessions}','destroy');
    Route::put('Traningupdate/{trainingSessions}','update');    
 });

 Route::controller(EmployeeTrainingsController::class)->group(function () {
    Route::get('Etraningindex','index'); 
    Route::post('Etraningstore','store');
    Route::delete('/Etraninggdelete/{employeeTrainings}','destroy');
    Route::put('Etraningupdate/{employeeTrainings}','update');    
 });

