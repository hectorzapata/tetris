<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableCatTipoCampos', "02_cat_tipocampos");


class CatTipoCampos extends Model {
    protected $table        = t2_tableCatTipoCampos;

    protected $primaryKey   = "cve_cat_tipocampo";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'tipo_campo',
        'activo'
    ];

}
