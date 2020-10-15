<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model{
  protected $table = "03_cat_municipio";
  protected $fillable = [
    "id", "valor", "entidad", "activo"
  ];
}
