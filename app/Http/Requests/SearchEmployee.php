<?php

namespace App\Http\Requests;

use App\Enums\EmployeeStatus;
use App\Enums\GenderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SearchEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "department" => ["string", "nullable"],
            "gender" => [ "nullable",],
            "employee" => [ "nullable",],
            "gender" => [ "nullable", new Enum(GenderStatus::class)],
            "employee" => [ "nullable", new Enum(EmployeeStatus::class)],
            "minSalary" => ["numeric", "min:0", "nullable"],
            "maxSalary" => ["numeric", "min:0", "nullable"]
        ];
    }
}
