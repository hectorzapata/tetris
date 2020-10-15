<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model{
  protected $table = "03_cat_zona";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
