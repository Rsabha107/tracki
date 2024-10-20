<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTimeSheet extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_timesheets';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function leave_statuses()
    {
        return $this->belongsTo(EmployeeLeaveStatus::class, 'status_id');
    }

    public function months()
    {
        return $this->hasOne(MonthsNames::class, 'month_selected');
    }

    public function entries()
    {
        return $this->hasMany(EmployeeTimeSheetEntry::class, 'employee_timesheet_id');
    }

    public function performer()
    {
        return $this->belongsTo(Employee::class, 'performer_id');
    }
}
