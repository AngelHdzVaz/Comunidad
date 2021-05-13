<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Empresas_empleado as EEmp;

class Publicacione extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'fecha_publicacion',
      'titulo',
      'resumen',
      'cuerpo',
      'autor',
      'activa'
    ];

public function autor_pub(){
    return $this->belongsTo(EEmp::class,'autor','uuid');
}

    public function comments(){
      return $this->hasMany('App\Models\Commentario', 'cuerpo');
    }




}
