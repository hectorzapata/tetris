<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model{
  protected $table = "03_cat_seccion";
  protected $fillable = [
    "id", "valor", "cve_03_cat_distritoLocal", "activo"
  ];
  public function obtDistritoLocal(){
    return $this->hasOne('Modules\Catalogos\Entities\DistritoLocal', 'id', 'cve_03_cat_distritoLocal');
  }
}
