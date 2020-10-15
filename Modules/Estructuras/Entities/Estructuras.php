<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableEstructuras', getenv('PREFIJO_AMBIENTE') . "02_t_estructura");


class Estructuras extends Model {
    protected $table        = t2_tableEstructuras;

    protected $primaryKey   = "cve_t_estructura";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'id_estructura',
        'nombre_estructura',
        'id_padre',
        'nivel',
        'consecutivo',
        'nombre_estructura',
        'descripcion',
        'cve_estado',
        'distrito_federal',
        'meta',
        'cve_usuario',
        'activo'
    ];

    // public function obtEntidad(){
    //     return $this->hasOne('Modules\Estructuras\Entities\Estados', 'cve_ent', 'cve_ent');
    // }

}
