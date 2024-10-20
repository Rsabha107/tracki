<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'elements';

    public function element_classificaitons()
    {
        return $this->belongsTo(ElementClassification::class, 'element_classification_id');
    }

    public function input_types()
    {
        return $this->belongsTo(InputType::class, 'input_type_id');
    }
}
