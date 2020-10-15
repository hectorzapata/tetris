<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Distritos extends Model{
  protected $table = 'cat_distritos';
  protected $primaryKey = "cve_cat_distritos";
  protected $fillable = [
    "seccion",
    "distrito_local",
    "distrito_federal",
    "descmpio",
    "mpio",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
