<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveStatus extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_leave_status';

}
