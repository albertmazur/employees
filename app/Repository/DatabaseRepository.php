<?php

namespace App\Repository;

use App\Enums\EmployeeStatus;
use App\Enums\GenderStatus;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class DatabaseRepository implements DatabaseInterface{

    private Employee $employeeModel;
    private Department $departmentModel;

    public function __construct(Employee $employee, Department $department){
        $this->employeeModel = $employee;
        $this->departmentModel = $department;
    }

    public function filterEmployee(string $gender = null, string $department = null, string $employee = null, int $minSalary = null, int $maxSalary = null, int $countPaginate = 30){
        $query = $this->employeeModel;

        if(isset($gender)) $query = $query->where("gender", $gender);
        
        if(isset($department)){
            $query = $query->whereHas("departments", function(Builder $q) use($department, $employee){
                if($employee === PresenceStatus::PRESENT->value){
                    $q->where([
                        ["departments.dept_no", $department],
                        ["dept_emp.to_date", ">=", Carbon::now()],
                        ["dept_emp.to_date", ">=", Carbon::now()]
                    ]);
                }
                elseif($employee === PresenceStatus::ABSENT->value){
                    $q->where([
                        ["departments.dept_no", $department],
                        ["dept_emp.to_date", "<", Carbon::now()],
                        ["dept_emp.to_date", "<", Carbon::now()],
                    ]);
                }
                else{
                    $q->where([
                        ["departments.dept_no", $department],
                    ]);
                }
            });
        }

        if(isset($minSalary)){
            $query = $query->whereHas("salary", function(Builder $q) use($minSalary){
                $q->where("salary", ">=", $minSalary);
            });
        }

        if(isset($maxSalary)){
            $query = $query->whereHas("salary", function(Builder $q) use($maxSalary){
                $q->where("salary", "<=", $maxSalary);
            });
        }

        $p = $query->paginate($countPaginate);
        
        // $collection = $p->getCollection();

        // $filteredCollection = $collection->filter(function($model) use ($department, $minSalary, $maxSalary) {
        //     $chech = false;
        //     if($department === "all") $chech=true;
        //     if($department !== "all" && $department==$model->currentDepartment()->dept_no){
        //         if($minSalary!=null && $minSalary<=$model->currentSalary()->salary) $chech=true;
        //         else $chech=false;
        //         if($maxSalary!=null && $maxSalary>=$model->currentSalary()->salary) $chech=true;
        //         else $chech=false;
        //         if(empty($minSalary) && empty($maxSalary) ) $chech=true;
        //     }
        //     if($chech) return $model;
        //   });

        //   $p->setCollection($filteredCollection);
        return $p;
    }

    public function allNameDepartments(){
        return $this->departmentModel::all();
    }

    public function downloadEmployee(array $id){
        return $this->employeeModel::find($id);
    }
}
