<?php

namespace Modules\AppMovil\Entities;

use Illuminate\Database\Eloquent\Model;

class RegistroIne extends Model{
  protected $table = "05_t_ine_app";
  protected $primaryKey = "cve_t_ine_app";
  protected $fillable = [
    "nombre",
    "apaterno",
    "amaterno",
    "domicilio",
    "clave",
    "curp",
    "aregistro",
    "estado",
    "municipio",
    "seccion",
    "localidad",
    "emision",
    "vigencia",
    "fnac",
    "edad",
    "sexo",
    "folio",
    "tel",
    "email",
    "facebook",
    "twitter",
    "ineimg",
    "cve_usuario"
  ];

  public function obtUsuario(){
    return $this->hasOne('\App\User', 'id', 'cve_usuario');
  }
}
