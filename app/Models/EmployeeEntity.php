<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEntity extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'employee_entity';

    public function employees()
    {
        return $this->hasMany(Employee::class, 'entity_id');
    }
}
