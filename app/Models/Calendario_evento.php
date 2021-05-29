<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario_evento extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'descripcion',
        'start',
        'end'
    ];
}
