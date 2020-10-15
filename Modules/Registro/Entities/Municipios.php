<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Municipios extends Model{
  protected $table = 'geo_municipios';
  protected $primaryKey = "cve_municipios";
  protected $fillable = [
    "cve_ent",
    "cve_mun",
    "nom_mun",
    "cve_cab",
    "nom_cab",
    "cve_geo_regiones"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}