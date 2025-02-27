<?php

namespace App\Repository;

interface DatabaseInterface{
    public function filterEmployee(
        string $firstName = "",
        string $lastName = "",
        string $gender = null,
        string $department = null,
        string $employeeStatus = null,
        int $minSalary = null,
        int $maxSalary = null,
        int $countPaginate = 30
    );
    public function allNameDepartments();
    public function downloadEmployees(array $id);
}
