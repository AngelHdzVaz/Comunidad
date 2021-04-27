<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas_correo extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_persona',
      'email_empresa',
      'email_personal'
];
}
