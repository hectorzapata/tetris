<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Telefonos extends Model{
  protected $table = '01_t_cat_telefonos';
  protected $primaryKey = "cve_t_cat_telefonos";
  protected $fillable = [
    "cve_t_registro_ciudadano",
    "cve_tipo_telefono",
    "numero_telefono",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
