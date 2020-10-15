<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Bitacora_Beneficiario extends Model{
  protected $table = '01_t_bitacora_gestion';
  protected $primaryKey = "cve_t_bitacora_gestion";
  protected $fillable = [
    "cve_t_gestion",
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
