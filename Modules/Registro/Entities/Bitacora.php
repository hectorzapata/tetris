<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Bitacora extends Model{
  protected $table = '01_t_bitacora';
  protected $primaryKey = "cve_t_bitacora";
  protected $fillable = [
    "cve_t_registro_ciudadano",
    "fecha",
    "hora",
    "movimiento",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";

  public function _Usuario(){
    return $this->hasOne('App\User', 'id', 'cve_usuario');
  	}

}
