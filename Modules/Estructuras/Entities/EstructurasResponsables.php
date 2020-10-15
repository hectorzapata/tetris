<?php

namespace Modules\Estructuras\Entities;

use Illuminate\Database\Eloquent\Model;


define('t2_tableEstructurasResponsables', "02_t_estructura_responsables");


class EstructurasResponsables extends Model {
    protected $table        = t2_tableEstructurasResponsables;

    protected $primaryKey   = "cve_t_estructura_responsable";
    const CREATED_AT = "fecha_creacion";
	const UPDATED_AT = "fecha_modificacion";

    protected $fillable = [
        'cve_t_estructura_nivel',
        'cve_t_responsabilidad',
        'cve_t_ciudadano',
        'id_titular',
        'meta',
        'cve_usuario',
        'activo'
    ];

    public function obtPersona(){
        return $this->hasOne('Modules\Registro\Entities\Ciudadano', 'cve_t_ciudadano', 'cve_t_ciudadano');
    }

    public function obtResponsabilidad(){
        return $this->hasOne('Modules\Estructuras\Entities\CatResponsabilidades', 'cve_cat_responsabilidad', 'cve_t_responsabilidad');
    }

    public function obtValores($opcion, $id){
        $nombre = '';
        $reg = \Modules\Registro\Entities\Ciudadano::find($id);
        if($reg) {
            if ($opcion == 1)
                $nombre = $reg->nombre .' ' .$reg->paterno .' ' .$reg->materno;
            if ($opcion == 2)
                $nombre = $reg->curp;
            if ($opcion == 3)
                $nombre = '...';
        }
        return $nombre;
    }
}
