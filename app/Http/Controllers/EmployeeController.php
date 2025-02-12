<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckIdEmployeesRequests;
use App\Http\Requests\SearchEmployeeRequests;
use App\Repository\DatabaseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    private DatabaseInterface $database;

    public function __construct(DatabaseInterface $databaseReposiotry){
        $this->database = $databaseReposiotry;
    }

    public function list(SearchEmployeeRequests $request){

        $data = $request->validated();

        $gender = $data["gender"] ?? null;
        $department = $data["department"] ?? null;
        $presence = $data["employee"] ?? null;
        $minSalary = $data["minSalary"] ?? null;
        $maxSalary = $data["maxSalary"] ?? null;

        $employees = $this->database->filterEmployee($gender, $department, $presence, $minSalary, $maxSalary);

        $data = [
            "gender" => $gender,
            "department" => $department,
            "presence" => $presence,
            "minSalary" => $minSalary,
            "maxSalary" => $maxSalary
        ];

        $employees->appends($data);

        return view("employees.tabela", [
            "employees" => $employees,
            "data" => $data,
            "departmentAll" => $this->database->allNameDepartments()
        ]);
    }

    public function download(CheckIdEmployeesRequests $request){

        $data = $request->validated();

        $employees = $this->database->downloadEmployee($data['employee_ids']);
        $list = [];

        foreach($employees as $e){
            $list[] = [
                "first_name" => $e->first_name,
                "last_name" => $e->last_name,
                "department" => $e->currentDepartment()->dept_name,
                "title" => $e->currentTitle()->title,
                "currentSalary" => $e->currentSalary()->salary,
                "sumSalary" => $e->sumSalaries()
            ];
        }

        $nameFile = "listEmployee.json";

        Storage::put($nameFile, json_encode($list));
        return Storage::download($nameFile, "list.json");
    }
}
