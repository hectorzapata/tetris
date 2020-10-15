<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Red_Social extends Model{
  protected $table = '01_t_cat_red_social';
  protected $primaryKey = "cve_t_cat_red_social";
  protected $fillable = [
    "cve_t_registro_ciudadano",
    "cve_cat_red_social",
    "nombre_usuario",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
