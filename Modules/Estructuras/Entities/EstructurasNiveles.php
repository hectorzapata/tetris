<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableEstructurasNiveles', getenv('PREFIJO_AMBIENTE') . "02_t_estructura_niveles");


class EstructurasNiveles extends Model {
    protected $table        = t2_tableEstructurasNiveles;

    protected $primaryKey   = "cve_t_estructura_nivel";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'cve_t_estructura',
        'id_estructura',
        'id_padre',
        'nivel',
        'consecutivo',
        'valor',
        'valor_hijo',
        'meta',
        'todo_nivel',
        'cve_usuario',
        'activo'
    ];

}
