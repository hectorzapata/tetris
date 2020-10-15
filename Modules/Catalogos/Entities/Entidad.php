<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model{
  protected $table = "03_cat_entidad";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
