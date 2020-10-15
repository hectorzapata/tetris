<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Suspender extends Model{
  protected $table = '01_t_suspender_registro';
  protected $primaryKey = "cve_t_suspender_registro";
  protected $fillable = [
    "cve_t_registro_ciudadano",
    "motivo",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
