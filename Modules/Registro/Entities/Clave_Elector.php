<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Clave_Elector extends Model{
  protected $table = 'maestro2';
  protected $fillable = [
    "CVE",
    "EDAD",
    "NOMBRE",
    "PATERNO",
    "MATERNO",
    "FECNAC",
    "SEXO",
    "CALLE",
    "NINT",
    "EXT",
    "COLONIA",
    "CP",
    "E",
    "D",
    "M",
    "S",
    "L",
    "MZA",
    "CONSEC",
    "CRED",
    "FOLIO",
    "NAC",
    "CURP"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";
}
