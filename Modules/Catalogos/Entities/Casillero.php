<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Casillero extends Model{
  protected $table = "03_cat_casillero";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
