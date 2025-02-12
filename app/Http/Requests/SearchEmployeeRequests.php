<?php

namespace App\Http\Requests;

use App\Enums\GenderStatus;
use App\Enums\PresenceStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SearchEmployeeRequests extends FormRequest
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
            "name" => ["nullable", "string"],
            "last-name" => ["nullable", "string"],
            "department" => ["nullable", "exists:departments,dept_no"],
            "gender" => ["nullable", Rule::in(array_map(fn($case) => $case->value, GenderStatus::cases()))],
            "presence" => ["sometimes", Rule::in(array_map(fn($case) => $case->value, PresenceStatus::cases()))],
            "minSalary" => ["numeric", "min:0", "nullable"],
            "maxSalary" => ["numeric", "min:0", "nullable"]
        ];
    }
}
