<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeApproval extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_approval_table';

    public function actions()
    {
        return $this->hasOne(EmployeeLeaveStatus::class, 'action_code_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'performer_id', 'id');
    }
}
