<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoGestion extends Model{
  protected $table = "03_cat_tipoGestion";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
