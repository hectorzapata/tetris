<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class DistritoFederal extends Model{
  protected $table = "03_cat_distritoFederal";
  protected $fillable = [
    "id", "valor", "cve_03_cat_municipio", "activo"
  ];
}
