<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class RelCasillaCasillero extends Model{
  protected $table = "03_rel_casilla_casillero";
  public $timestamps = false;
  protected $fillable = [
    "cve_03_cat_casilla",
    "cve_03_cat_casillero"
  ];
  public function obtCasillero(){
    return $this->hasOne('\Modules\Catalogos\Entities\Casillero', 'id', 'cve_03_cat_casillero');
  }
}
