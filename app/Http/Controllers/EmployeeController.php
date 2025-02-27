<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckIdEmployeesRequests;
use App\Http\Requests\SearchEmployeeRequests;
use App\Repository\DatabaseInterface;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    private DatabaseInterface $database;

    public function __construct(DatabaseInterface $databaseRepository){
        $this->database = $databaseRepository;
    }

    public function list(SearchEmployeeRequests $request){
        $data = $request->validated();

        $data = [
            "first-name" => $data["first-name"] ?? '',
            "last-name" => $data["last-name"] ?? '',
            "gender" => $data["gender"] ?? null,
            "department" => $data["department"] ?? null,
            "presence" => $data["presence"] ?? null,
            "minSalary" => $data["minSalary"] ?? null,
            "maxSalary" => $data["maxSalary"] ?? null
        ];

        $employees = $this->database->filterEmployee(
            $data["first-name"],
            $data["last-name"],
            $data["gender"],
            $data["department"],
            $data["presence"],
            $data["minSalary"],
            $data["maxSalary"]
        );

        $employees->appends($data);

        return view("employees.tabela", [
            "employees" => $employees,
            "data" => $data,
            "departmentAll" => $this->database->allNameDepartments()
        ]);
    }

    public function download(CheckIdEmployeesRequests $request){
        $data = $request->validated();

        $employees = $this->database->downloadEmployees($data['employee_ids']);
        $list = [];

        foreach($employees as $e){
            $list[] = [
                "first_name" => $e->first_name,
                "last_name" => $e->last_name,
                "department" => $e->departments[0]->dept_name,
                "title" => $e->titles[0]->title,
                "currentSalary" => $e->salaries[0]->salary,
                "sumSalary" => $e->sumSalaries()
            ];
        }

        $nameFile = "listEmployee.json";

        Storage::put($nameFile, json_encode($list));
        return Storage::download($nameFile, "list.json");
    }
}
