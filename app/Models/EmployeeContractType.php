<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeContractType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'employee_contract_types';

    public function employees()
    {
        return $this->hasMany(Employee::class, 'contract_type_id');
    }
}
