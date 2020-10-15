<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class RangoEdad extends Model{
  protected $table = "03_cat_rangoEdad";
  protected $fillable = [
    "id", "valor", "activo" 
  ];
}
