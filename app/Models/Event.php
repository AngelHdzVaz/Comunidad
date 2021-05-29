<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table= 'calendario_eventos';
    //
    protected $fillable = [
        'titulo', 'descripcion', 'fecha',
    ];
    public $timestamps = false;
}
