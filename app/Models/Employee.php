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
        return $this->belongsToMany(Department::class, "dept_emp", "emp_no", "dept_no")->withPivot('from_date', 'to_date');;
    }

    public function currentDepartment(){
        return $this->departments()->orderBy("dept_emp.to_date", "DESC")->first();
    }

    public function title(){
        return $this->hasMany(Title::class, "emp_no");
    }

    public function currentTitle(){
        return $this->title()->orderBy("to_date", "DESC")->first();
    }

    public function salary(){
        return $this->hasMany(Salary::class, "emp_no");
    }

    public function currentSalary(){
        return $this->salary()->orderBy("to_date", "DESC")->first();
    }

    public function sumaSalaries(){
        return $this->salary()->sum("salary");
    }
}
