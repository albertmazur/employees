<?php

namespace App\Repository;

interface DatabaseInterface{

    public function filterEmployee(string $gender = "all", string $department = "all", string $employee = "all", int $minSalary = null, int $maxSalary = null);
    public function allNameDepartments();
    public function downloadEmployee(array $id);
}
