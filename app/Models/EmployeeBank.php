<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBank extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_banks';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
