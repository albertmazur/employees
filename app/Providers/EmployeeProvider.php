<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Employee;
use App\Repository\DatabaseInterface;
use App\Repository\DatabaseRepository;
use Illuminate\Support\ServiceProvider;

class EmployeeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(DatabaseInterface::class, function($app){
            return new DatabaseRepository($app->make(Employee::class), $app->make(Department::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
