<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Casilla extends Model{
  protected $table = "03_cat_casilla";
  protected $fillable = [
    "id",
    "cve_03_cat_seccion",
    "padron",
    "listado_nominal",
    "cve_03_cat_claseCasilla",
    "cve_03_casillero",
    "domicilio",
    "localidad_manzana",
    "ubicación",
    "referencia",
    "cve_03_cat_tipoDomicilioCasilla",
    "activo"
  ];
  public function obtSeccion(){
    return $this->hasOne('Modules\Catalogos\Entities\Seccion', 'id', 'cve_03_cat_seccion');
  }
  public function obtTipoCasilla(){
    return $this->hasOne('Modules\Catalogos\Entities\TipoCasilla', 'id', 'cve_03_cat_tipoCasilla');
  }
  public function obtCasilleros(){
    return $this->hasMany('Modules\Catalogos\Entities\RelCasillaCasillero', 'cve_03_cat_casilla', 'id');
  }
}
