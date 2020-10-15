<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model{
  protected $table = "03_cat_lugar";
  protected $fillable = [
    "id",
    "valor",
    "localidad_manzana",
    "ubicacion",
    "referencia",
    "cve_03_cat_tipoDomicilioCasilla",
    "activo"
  ];
}
