<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableCatEstados', "cat_estados");


class CatEstados extends Model {
    protected $table        = t2_tableCatEstados;

    protected $primaryKey   = "cve_estado";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'nom_estado',
        'activo'
    ];

}
