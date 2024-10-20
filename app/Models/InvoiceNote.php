<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceNote extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table='invoice_notes';
}
