<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_areas_empresariale extends Model
{
    use HasFactory;
    protected $fillable = [
      'icono',
      'area',
      'descripcion',
      'precio'
    ];
}
