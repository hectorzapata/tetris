<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Registro_Ciudadano extends Model{
  protected $table = '01_t_registro_ciudadano';
  protected $primaryKey = "cve_t_registro_ciudadano";
  protected $fillable = [
    "nombre_estructura",
    "cve_nivel",
    "cve_responsable",
    "cve_poligono",
    "cve_cedula",
    "correo_electronico",
    "estatus",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
