<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Beneficiarios extends Model{
  protected $table = '01_t_beneficiarios';
  protected $primaryKey = "cve_t_beneficiario";
  protected $fillable = [
    "cve_t_gestiones",
    "cve_t_ciudadano",
    "nombre",
    "paterno",
    "materno",
    "curp",
    "fecha_modal",
    "domicilio",
    "telefono",
    "representante",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";


}
