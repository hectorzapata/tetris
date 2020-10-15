<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Domicilio extends Model{
  protected $table = 't_domicilio';
  protected $primaryKey = "cve_t__domicilio";
  protected $fillable = [
    "cve_t_ciudadano",
    "cve_ent",
    "cve_mun",
    "ageb",
    "cve_loc",
    "localidad",
    "manzana",
    "cve_calle",
    "calle_domicilio",
    "tipo_calle",
    "num_int",
    "num_int_alf",
    "num_ext",
    "num_ext_alf",
    "tipo_asen",
    "cve_asen",
    "nombre_asentamiento",
    "cp",
    "cve_via_ref1",
    "calle_ref1",
    "tipo_ref1",
    "cve_via_ref2",
    "calle_ref2",
    "tipo_ref2",
    "cve_via_ref3",
    "calle_ref3",
    "tipo_ref3",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
