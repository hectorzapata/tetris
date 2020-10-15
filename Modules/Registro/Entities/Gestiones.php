<?php
namespace Modules\Registro\Entities;

use Illuminate\Database\Eloquent\Model;

//define('ms030_tablaAnio', getenv('PREFIJO_AMBIENTE') . "ms030.cat_anos_productividad");

class Gestiones extends Model{
  protected $table = '01_t_gestiones';
  protected $primaryKey = "cve_t_gestiones";
  protected $fillable = [
    "cve_t_ciudadano",
    "origen_peticion",
    "tipo_peticion",
    "categoria_peticion",
    "fecha_recepcion",
    "fecha_atendido",
    "fecha_entrega",
    "municipio",
    "gestor",
    "procedencia_gestor",
    "descripcion_gestor",
    "apoyo_otorgado",
    "estatus",
    "cve_usuario",
    "activo"
  ];

  const CREATED_AT = "created_at";
  const UPDATED_AT = "updated_at";

  public function obtMUN(){
    return $this->hasOne('Modules\Catalogos\Entities\Municipio', 'id', 'municipio');
  }

  public function obtCategoria(){
    return $this->hasOne('Modules\Catalogos\Entities\TipoGestion', 'id', 'categoria_peticion');
  }

  public function obtGestor(){
    return $this->hasOne('Modules\Catalogos\Entities\Gestor', 'id', 'gestor');
  }
}
