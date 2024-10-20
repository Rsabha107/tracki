<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_salary';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
