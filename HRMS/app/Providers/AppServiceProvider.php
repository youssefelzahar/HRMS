<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\interface\BaseInterface;
use App\BaseRepo\BaseRpo;
use App\ControllerRepo\EmployeeRepository;
use App\ControllerRepo\DepartementRepository;
use App\Models\Departments;
use App\Models\LeaveTypes;
use App\ControllerRepo\LeaveTypeRepo;
use App\ControllerRepo\AttendenceReprository;
use App\ControllerRepo\DocumentsRepository;
use App\ControllerRepo\SalariesRepository;
use App\ControllerRepo\AuthReprository;
use App\ControllerRepo\RoleReprositroy;
use App\ControllerRepo\TrainingSesionsReprository;
use App\ControllerRepo\EmployeeTraningReprository;
use App\ControllerRepo\LeaveRequestReprository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(EmployeeRepository::class, function($app) {
            return new EmployeeRepository(new \App\Models\Employees);
        });

        // Bind Department repository
        $this->app->bind(DepartementRepository::class, function($app) {
            return new DepartementRepository(new \App\Models\Departments);
        });

        $this->app->bind(LeaveTypeRepo::class, function($app) {
            return new LeaveTypeRepo(new \App\Models\LeaveTypes);
        });

        $this->app->bind(AttendenceReprository::class, function($app) {
            return new AttendenceReprository(new \App\Models\Attendance);
        });

        $this->app->bind(DocumentsRepository::class, function($app) {
            return new DocumentsRepository(new \App\Models\Documents);
        });

        $this->app->bind(SalariesRepository::class, function($app) {
            return new SalariesRepository(new \App\Models\Salaries);
        });

        $this->app->bind(AuthReprository::class, function($app) {
            return new AuthReprository(new \App\Models\User);
        });

        $this->app->bind(RoleReprositroy::class, function($app) {
            return new RoleReprositroy(new \App\Models\Roles);
        });

        $this->app->bind(TrainingSesionsReprository::class, function($app) {
            return new TrainingSesionsReprository(new \App\Models\TrainingSessions);
        });

        $this->app->bind(EmployeeTraningReprository::class, function($app) {
            return new EmployeeTraningReprository(new \App\Models\EmployeeTrainings);
        });

        $this->app->bind(LeaveRequestReprository::class, function($app) {
            return new LeaveRequestReprository(new \App\Models\LeaveRequests);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
