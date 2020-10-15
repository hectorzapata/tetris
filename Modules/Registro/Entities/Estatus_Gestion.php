<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Estatus_Gestion extends Model{
  protected $table = '01_t_estatus_gestiones';
  protected $primaryKey = "cve_t_estatus_gestiones";
  protected $fillable = [
    "cve_t_gestiones",
    "estatus",
    "fecha_atendido",
    "fecha_entregada",
    "apoyo_otorgado",
    "descripcion_estatus",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";

}
