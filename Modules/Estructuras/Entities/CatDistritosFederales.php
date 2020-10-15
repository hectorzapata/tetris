<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableCatDistritosFederales', "02_cat_distritos_federales");


class CatDistritosFederales extends Model {
    protected $table        = t2_tableCatDistritosFederales;

    protected $primaryKey   = "cve_cat_distritofederal";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'cve_estado',
        'cabecera',
        'integrado',
        'activo'
    ];

}
