<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Ciudadano extends Model{
  protected $table = 't_ciudadano';
  protected $primaryKey = "cve_t_ciudadano";
  protected $fillable = [
    "nombre",
    "paterno",
    "materno",
    "rfc",
    "curp",
    "genero",
    "fecha_naciminto",
    "estado_nacimiento",

    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
