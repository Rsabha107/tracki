<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'marital_statuses';

    public function employees()
    {
        return $this->hasMany(Employee::class, 'marital_status_id');
    }
}
