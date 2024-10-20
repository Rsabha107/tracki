<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Termwind\Components\Element;

class ElementClassification extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'element_classifications';

    public function elements()
    {
        return $this->belongsTo(Element::class, 'element_classificaiton_id');
    }
}
