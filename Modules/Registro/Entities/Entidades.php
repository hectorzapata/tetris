<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Entidades extends Model{
  protected $table = 'cat_estados';
  protected $primaryKey = "cve_estado";
  protected $fillable = [
    "nom_estado",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}