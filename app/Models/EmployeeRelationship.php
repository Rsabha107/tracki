<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRelationship extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'relationships';

    public function employee_emergency()
    {
        return $this->belongsTo(EmployeeEmergencyContact::class, 'relationship_id');
    }

}
