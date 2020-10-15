<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class DistritoLocal extends Model{
  protected $table = "03_cat_distritoLocal";
  protected $fillable = [
    "id", "valor", "cve_03_cat_municipio", "activo"
  ];
  public function obtMunicipio(){
    return $this->hasOne('Modules\Catalogos\Entities\Municipio', 'id', 'cve_03_cat_municipio');
  }
}
