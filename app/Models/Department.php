<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = "dept_no";
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    public function employee(){
        return $this->belongsToMany(Employee::class, "dept_emp", "dept_no", "emp_no");
    }

    public function employeeManager(){
        return $this->belongsToMany(Employee::class, "dept_manager", "dept_no", "emp_no");
    }
}
