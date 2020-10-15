<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class MotivoLlamada extends Model{
  protected $table = "03_cat_motivoLlamada";
  protected $fillable = [
    "id", "valor", "activo"
  ];
}
