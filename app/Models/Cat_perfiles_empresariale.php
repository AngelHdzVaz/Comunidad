<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_perfiles_empresariale extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_area',
      'perfil',
      'descripcion',
      'precio'
];
}
