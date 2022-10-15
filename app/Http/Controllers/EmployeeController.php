<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchEmployee;
use App\Repository\DatabaseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    private DatabaseInterface $database;

    public function __construct(DatabaseInterface $databaseReposiotry){
        $this->database = $databaseReposiotry;
    }

    public function list(SearchEmployee $request){

        $data = $request->validated();

        $gender = $data["gender"] ?? "all";
        $department = $data["department"] ?? "all";
        $employee = $data["employee"] ?? "all";
        $minSalary = $data["minSalary"] ?? null;
        $maxSalary = $data["maxSalary"] ?? null;

        $employees = $this->database->filterEmployee($gender, $department, $employee, $minSalary, $maxSalary);

            $d = [
                "gender" => $gender,
                "department" => $department,
                "employee" => $employee,
                "minSalary" => $minSalary,
                "maxSalary" => $maxSalary
            ];

            $employees->appends($d);

        return view("employees.tabela", [
            "employees" => $employees,
            "gender" => $gender,
            "department" => $department,
            "employee" => $employee,
            "minSalary" => $minSalary,
            "maxSalary" => $maxSalary,
            "departmentAll" => $this->database->allNameDepartments()
        ]);
    }

    public function download(Request $request){

        $data = $request->get("id");

        $employees = $this->database->downloadEmployee($data);
        $list = [];

        foreach($employees as $e){
            $list[] = [
                "first_name" => $e->first_name,
                "last_name" => $e->last_name,
                "department" => $e->currentDepartment()->dept_name,
                "title" => $e->currentTitle()->title,
                "currentSalary" => $e->currentSalary()->salary,
                "sumaSalary" => $e->sumaSalaries()
            ];
        }

        $nameFile = "listEmployee.json";

        Storage::put($nameFile, json_encode($list));
        return Storage::download($nameFile, "list.json");
    }
}
