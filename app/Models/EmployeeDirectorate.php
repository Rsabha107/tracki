<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDirectorate extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'directorate';

    public function employees()
    {
        return $this->hasMany(Employee::class, 'directorate_id');
    }
}
