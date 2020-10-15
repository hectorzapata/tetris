<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class ClaseCasilla extends Model{
  protected $table = "03_cat_claseCasilla";
  protected $fillable = [
    "id",
    "valor",
    "activo"
  ];
}
