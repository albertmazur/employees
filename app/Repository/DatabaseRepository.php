<?php

namespace App\Repository;

use App\Models\Title;
use App\Models\Employee;
use App\Models\Department;
use App\Enums\PresenceStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class DatabaseRepository implements DatabaseInterface{

    private Employee $employeeModel;
    private Department $departmentModel;
    private Title $titleModel;

    public function __construct(Employee $employee, Department $department, Title $title){
        $this->employeeModel = $employee;
        $this->departmentModel = $department;
        $this->titleModel = $title;
    }

    private function addSubJoin($query, $table_name){
        $subQuery = DB::table($table_name)->selectRaw("emp_no, Max(to_date) as max_to_date, Max(from_date) as max_from_date")
        ->groupBy("emp_no");

        $query->joinSub($subQuery, 'latest_'.$table_name, function($join) use($table_name){
            $join->on($table_name.'.emp_no', '=', 'latest_'.$table_name.'.emp_no')
            ->on($table_name.'.to_date', '=', 'latest_'.$table_name.'.max_to_date')
            ->on($table_name.'.from_date', '=', 'latest_'.$table_name.'.max_from_date');
        });
        $query->join($table_name, $table_name.".emp_no", "=", "employees.emp_no");
    }

    public function filterEmployee(
        string $firstName = '',
        string $lastName = '',
        string $gender = null,
        string $department = null,
        string $employeeStatus = null,
        int $minSalary = null,
        int $maxSalary = null,
        int $countPaginate = 30
        ){
        $query = Employee::with(['departments', 'titles', 'salaries']);

        if ($department || $employeeStatus){
            $this->addSubJoin($query, 'dept_emp');
            $query->join('departments', 'dept_emp.dept_no', "=", "departments.dept_no");
            if($department) $query->where('departments.dept_no', "=", $department);

            if($employeeStatus === PresenceStatus::PRESENT->value) $query->where('dept_emp.to_date', ">=", Carbon::now());
            elseif ($employeeStatus === PresenceStatus::ABSENT->value) $query->where('dept_emp.to_date', "<", Carbon::now());
        }

        if($minSalary || $maxSalary){
            $this->addSubJoin($query, 'salaries');
            if($minSalary) $query->where('salaries.salary', '=>', $minSalary);
            if($maxSalary) $query ->where('salaries.salary', '<=', $maxSalary);
        }

        if ($firstName !== ''){
            $query->where('first_name', 'LIKE', "%$firstName%");
        }

        if ($lastName !== ''){
            $query->where('last_name', 'LIKE', "%$lastName%");
        }

        if (!is_null($gender)){
            $query->where('gender', $gender);
        }

        return $query->paginate($countPaginate);
    }

    public function allNameDepartments(){
        return $this->departmentModel::all();
    }

    public function allNameTitles(){
        return $this->titleModel::all();
    }

    public function downloadEmployees(array $ids){
        return $this->employeeModel::findOrFail($ids);
    }
}
