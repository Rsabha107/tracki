<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table='genders';

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'gender_id');
    }
}
