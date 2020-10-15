<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Colonia extends Model{
  protected $table = "03_cat_colonia";
  protected $fillable = [
    "id", "valor", "cp", "activo"
  ];
}
