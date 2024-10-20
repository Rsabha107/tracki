<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTimeSheetEntry extends Model
{
    use HasFactory;

    protected $table = 'employee_timesheet_entries';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function timesheet()
    {
        return $this->belongsTo(EmployeeTimeSheet::class, 'employee_timesheet_id');
    }

    public function entry_actions()
    {
        return $this->hasOne(EmployeeTimesheetEntryAction::class, 'code', 'day_action');
    }
}
