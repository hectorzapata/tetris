<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableCatDistritosLocales', "02_cat_distritos_locales");


class CatDistritosLocales extends Model {
    protected $table        = t2_tableCatDistritosLocales;

    protected $primaryKey   = "cve_cat_distritolocal";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'cve_estado',
        'cabecera',
        'integrado',
        'secciones',
        'activo'
    ];

}
