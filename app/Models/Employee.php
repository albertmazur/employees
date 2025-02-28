<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'emp_no';

    public $timestamps = false;

    public function departments(){
        return $this->belongsToMany(Department::class, "dept_emp", "emp_no", "dept_no")
            ->withPivot('from_date', 'to_date')
            ->orderByDesc('dept_emp.to_date');
    }

    public function manager(){
        return $this->belongsToMany(Department::class, "dept_manager", "emp_no", "dept_no")
            ->withPivot('from_date', 'to_date')
            ->orderByDesc('dept_manager.to_date');
    }

    public function titles(){
        return $this->hasMany(Title::class, "emp_no")
            ->orderByDesc('to_date');
    }

    public function salaries(){
        return $this->hasMany(Salary::class, "emp_no")
            ->orderByDesc('to_date');
    }

    public function sumSalaries(){
        return $this->salaries()->sum("salary");
    }
}
