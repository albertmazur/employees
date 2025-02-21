<?php

namespace App\Http\Requests;

use App\Enums\GenderStatus;
use App\Enums\PresenceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            "first-name" => ["nullable", "string"],
            "last-name" => ["nullable", "string"],
            "department" => ["nullable", "exists:departments,dept_no"],
            "gender" => ["nullable", new Enum(GenderStatus::class)],
            "presence" => ["nullable", new Enum(PresenceStatus::class)],
            "minSalary" => ["numeric", "min:0", "nullable"],
            "maxSalary" => ["numeric", "min:0", "nullable"]
        ];
    }
}
