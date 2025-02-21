<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptEmp extends Model
{
    use HasFactory;

    protected $table = 'dept_emp';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}
