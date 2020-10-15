<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Region extends Model{
  protected $table = "03_cat_region";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
