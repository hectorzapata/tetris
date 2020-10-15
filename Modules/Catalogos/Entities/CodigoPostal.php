<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class CodigoPostal extends Model{
  protected $table = "03_cat_codigoPostal";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
