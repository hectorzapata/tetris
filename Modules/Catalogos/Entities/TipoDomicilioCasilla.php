<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoDomicilioCasilla extends Model{
  protected $table = "03_cat_tipoDomicilioCasilla";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
