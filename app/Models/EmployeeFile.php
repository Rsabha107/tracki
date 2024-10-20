<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFile extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_files';

    public function emps()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
