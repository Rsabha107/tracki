<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEmergencyContact extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'employee_emergency_contacts';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function relationships()
    {
        return $this->hasOne(EmployeeRelationship::class, 'id', 'relationship_id');
    }
}
