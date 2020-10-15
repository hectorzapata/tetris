<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoCasilla extends Model{
  protected $table = "03_cat_tipoCasilla";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
