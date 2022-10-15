<?php

namespace App\Enums;

enum EmployeeStatus: string{
    case All = "all";
    case ABSENT ="absent";
    case PRESENT = "present";
}
