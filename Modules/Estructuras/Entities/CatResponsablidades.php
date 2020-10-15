<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableCatResponsabilidades', "02_cat_responsabilidades");


class CatResponsabilidades extends Model {
    protected $table        = t2_tableCatResponsabilidades;

    protected $primaryKey   = "cve_cat_responsabilidad";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'id_tipo',
        'responsabilidad',
        'activo'
    ];

}
