<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Ine extends Model{
  protected $table = 't_ine';
  protected $primaryKey = "cve_t_ine";
  protected $fillable = [
    "cve_t_ciudadano",
    "clave_elector",
    "seccion_ine",
    "vigencia_ine",
    "calle_ine",
    "num_ext_ine",
    "num_int_ine",
    "colonia_ine",
    "cp_ine",
    "estado_ine",
    "municipio_ine",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";



}
