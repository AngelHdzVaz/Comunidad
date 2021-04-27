<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas_area extends Model
{
    use HasFactory;
    protected $fillable = [
      'codigo_empresa',
      'ide_area'
];
}
