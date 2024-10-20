<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeJobLevel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'job_level';
}
