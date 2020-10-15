<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Gestor extends Model{
  protected $table = "03_cat_gestor";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
