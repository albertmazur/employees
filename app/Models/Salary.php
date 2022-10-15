<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $primaryKey = "from_date";
    protected $keyType = 'Date';
    public $incrementing = false;

    public $timestamps = false;

    public function employee(){
       return $this->belongsTo(Employee::class);
    }
}
