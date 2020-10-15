<?php

namespace Modules\Estructuras\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

use \Modules\Estructuras\Entities\CatEstados;
use \Modules\Estructuras\Entities\CatTipoCampos;
use \Modules\Estructuras\Entities\CatResponsabilidades;

use \Modules\Estructuras\Entities\Estructuras;
use \Modules\Estructuras\Entities\EstructurasNiveles;
use \Modules\Estructuras\Entities\EstructurasResponsables;

use \Modules\Estructuras\Entities\CatDistritosFederales;
use \Modules\Estructuras\Entities\CatDistritosLocales;

// Catalogos
use \Modules\Catalogos\Entities\DistritoFederal;
use \Modules\Catalogos\Entities\DistritoLocal;
use \Modules\Catalogos\Entities\Zona;
use \Modules\Catalogos\Entities\Seccion;
use \Modules\Catalogos\Entities\Entidad;

// Ciudadanos
use \Modules\Registro\Entities\Ciudadano;

// Globales
use \Carbon\Carbon;
use App\Classes\Notificaciones;
use App\User;
use Auth;
use DB;


class GeneralesController extends Controller {

    use Notificaciones;
    public $base;

    public function __construct() {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set ('America/Mexico_City');
        \DB::statement("SET lc_time_names = 'es_ES'");

        $this->base = getenv('PREFIJO_AMBIENTE');
    }

    public function lista_distritos ($estado = 28, $tipo = 1) {
        $data = null;
        if ($tipo == 0 || $tipo == 1) {
            $data['federales']  = CatDistritosFederales::where([ ['activo', 1], ['cve_estado', $estado] ])
                                ->get();
        }
        if ($tipo == 0 || $tipo == 2) {
            $data['locales']    = DistritosLocales::where('activo', 1)
                                ->get();
        }
        return $data;
    }


    public function lista_niveles ($estructura, $tipo = 1) {
        $columnas = ($tipo == 1) ? 4 : 3;
        $data = null;
        $registros  = Estructuras::where([ ['activo', 1], ['id_estructura', $estructura], ['consecutivo', '>', 1] ])
                    ->orderBy('consecutivo', 'asc')
                    ->get();
        $t = '';
        $t .= '<div style="margin-left:8%;">';
        $t .= '<table class="table table-bordered table-checkable dataTable no-footer dtr-inline collapsed blanco" role="grid" aria-describedby="kt_datatable_info">';
            $t .= '<thead>';
                $t .= '<tr role="row">';
                    $t .= '<th style="width: 10%;">Número</th>';
                    $t .= '<th style="width: 40%;">Tipo de Campo</th>';
                    $t .= '<th style="width: 40%;">Descripción</th>';
                    if($tipo == 1)
                        $t .= '<th style="width: 10%;"></th>';

                $t .= '</tr>';
            $t .= '</thead>';

            $t .= '<tbody>';

        $ind = 0;
        if (count($registros) > 0) {
            $cambia = 0;
            foreach ($registros as $key => $value) {
                $ind ++;
                $cambia = ($cambia == 0) ? 1 : 0;
                $clase = ($cambia == 1) ? 'odd' : 'even';
                $tipo_campo  = CatTipoCampos::where([ ['activo', 1], ['cve_cat_tipocampo', $value->nivel] ])
                            ->value('tipo_campo');

                $t .= '<tr role="row" class="' .$clase .'">';
                    $t .= '<td>' .$ind .'</td>';
                    $t .= '<td>' .$tipo_campo .'</td>';
                    $t .= '<td>' .$value->descripcion .'</td>';
                    if($tipo == 1) {
                        $t .= '<td >';

                            $t .= "<div class='dropdown dropdown-inline mr-4'>";
                              $t .= "<button type='button' class='btn btn-light-primary btn-icon btn-sm' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                                  $t .= "<i class='ki ki-bold-more-hor'></i>";
                              $t .= "</button>";
                              $t .= "<div class='dropdown-menu'>";
                                    $t .= '<a class="dropdown-item" href="/estructuras/configurar/niveles/' .$value->cve_t_estructura .'/edit">Editar </a>';
                                    $t .= '<a class="dropdown-item" href="" onclick="eliminar_nivel(' .$value->cve_t_estructura .');">Eliminar </a>';
                                $t .= '</div>';
                            $t .= '</div>';
                        $t .= '</td>';
                    }
                $t .= '</tr>';
            }
        }
        else {
            $t .= '<tr role="row" class="odd">';
                $t .= '<td colspan="' .$columnas .'" style="text-align: center;"><b>No existen niveles en esta estructura </b></td>';
            $t .= '</tr>';
        }

        if ($tipo == 0) {
                $t .= '</tbody>';
            $t .= '</table>';
            $t .= '</div>';
        }
        return ($ind > 0) ? $t : null;
    }

    public function datos_nivel ($nivel) {
        $data   = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $nivel] ])
                ->get();

        return $data;
    }



    public function buscaEstructuras($id = 0) {
        $registros  = Estructuras::where([ ['activo', 1], ['id_estructura', $id] ])
                    ->orderBy('consecutivo', 'asc')
                    ->get();

        $estructuras = [];
        foreach ($registros as $key => $value) {
            $estructuras [] = array (
                                'id' => $value->cve_t_estructura,
                                'id_padre' => $value->id_padre,
                                'consecutivo' => $value->consecutivo,
                                'nivel' => $value->nivel,
                                'id_estructura' => $value->id_estructura,
                                'nombre_estructura' => $value->nombre_estructura,
                                'descripcion' => $value->descripcion
                            );
        }

        return $estructuras;
    }


    public function datos_estructura ($id) {
        $registros  = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $id] ])
                    ->orderBy('nombre_estructura', 'asc')
                    ->get();

        $estructuras = [];
        foreach ($registros as $key => $value) {
            $responsable        = EstructurasResponsables::where([
                                    ['activo', 1], ['cve_t_estructura_responsable', $value->id]
                                ])->get();

            $estructuras [] = array (
                                'id' => $value->cve_t_estructura,
                                'id_estructura' => $value->id_estructura,
                                'id_padre' => $value->id_padre,
                                'consecutivo' => $value->consecutivo,
                                'nivel' => $value->nivel,
                                'nombre_estructura' => $value->nombre_estructura,
                                'descripcion' => $value->descripcion);
        }
        return $estructuras;
    }

    // solo muestra las estructuras con niveles registrados
    public function lista_estructuras () {
//        $regs   = Estructuras::where([ ['activo', 1], ['id_padre', 0], ['cve_usuario', Auth::user()->id] ])
        $regs   = Estructuras::where([ ['activo', 1], ['id_padre', 0] ])
                ->orderBy('id_estructura', 'asc')
                ->get();

        $estructuras = [];
        foreach ($regs as $key0 => $value0) {
            $tiene = Estructuras::where([ ['activo', 1], ['id_estructura', $value0->id_estructura] ])->count();

            if ($tiene > 1) {
                $registros  = Estructuras::where([ ['activo', 1], ['id_estructura', $value0->id_estructura] ])
                            ->orderBy('id_estructura', 'asc')
                            ->orderBy('consecutivo', 'asc')
                            ->get();

                $anterior = 1;
                $texto_anterior = 'Región';
                $valor_anterior = 0;
                foreach ($registros as $key => $value) {
                    $valor_anterior = EstructurasNiveles::where([ ['activo', 1],
                                                                    ['cve_t_estructura', $value->id_padre]
                                                                ])->value('valor');
                    $nombre_estado = Entidad::where([ ['activo', 1],
                                                                    ['id', $value->cve_estado]
                                                                ])->value('valor');
                    $estructuras [] = array (
                                        'id' => $value->cve_t_estructura,
                                        'id_estructura' => $value->id_estructura,
                                        'id_padre' => $value->id_padre,
                                        'consecutivo' => $value->consecutivo,
                                        'nivel' => $value->nivel,
                                        'nivel_anterior' => $anterior,
                                        'texto_anterior' => $texto_anterior,
                                        'valor_anterior' => $valor_anterior,
                                        'cve_estado' => $value->cve_estado,
                                        'nombre_estado' => $nombre_estado,
                                        'distrito_federal' => $value->distrito_federal,
                                        'nombre_estructura' => $value->nombre_estructura,
                                        'descripcion' => $value->descripcion);
                    if($value->nivel < 5) {
                        $anterior = $value->nivel;
                        $texto_anterior = $value->descripcion;
                    }
                }
            }
        }

        return $estructuras;
    }


    public function datos_responsable ($id, $elimina = '') {
        $registro        = EstructurasResponsables::where([
                                    ['activo', 1], ['cve_t_estructura_responsable', $id]
                                ])->get();

        $nombre_responsable = '';
        $puesto             = '';
        foreach($registro as $key => $responsable) {
            $nombre_responsable  = $responsable->nombre;
            $nombre_responsable .= ($responsable->apellidos) ? ' ' .$responsable->apellidos : '';
        }
        return array($nombre_responsable, $puesto);
    }



    public function create_estructura (Request $request) {
        $datos = $request->all();

        $id_usuario = Auth::user()->id;

        try {
            $datos ['id_usuario'] = $id_usuario;
            $datos ['id_padre'] = (int) $datos ['id_padre'];

            $estructura = Estructuras::create( $datos );
            $id_estructura = $estructura->id;

            // $estructura = Estructuras::find($id_estructura);
            // $estructura->id_usuario = $id_usuario;
            // $estructura->save();


            // actualizar responsable
            $resultado = $this->actualiza_responsable($datos, $id_estructura);

            flash('Área registrada con éxito')->success();
            return redirect('/estructuras/configurar/create');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error al intentar crear la estructura";
            switch ($e->getCode()) {
            case '23000':
                $mensaje = "Lo sentimos, ya existe una estructura registrada con este nombre " . $request->nombre_estructura;
                break;
            }
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }




    public function update_estructura (Request $request, $id) {
        $datos = $request->all();
//        $id_usuario = Auth::user()->id;

        try {

            if ($id > 0) {
                $estructura = Estructuras::find($id);
                $estructura->fill($datos);
                $estructura->save();

                // actualizar responsable
                $resultado = $this->actualiza_responsable($datos, $id);
            }

            return $this->resp_correcta('Aviso', "Área actualizada con éxito");

        } catch (\Exception $e) {
            return $this->resp_error('Aviso', "Ocurrió un error al actualizar el área", "", [
                "e" => $e->getMessage()
            ]);
        }
    }



    public function delete_estructura ($id) {
        try {
            $estructura = Estructuras::find($id);
            $estructura->activo = 0;
            $estructura->save();

            // id_estructura en estructuras responsables
            $query   = "UPDATE " .$this->base ."cat_estructuras_responsables SET activo = 0 ";
            $query  .= "WHERE id_estructura = " .$id;
            $estructura = DB::select($query);

            // id_padre en estructuras
            $registros = Estructuras::where([ ['activo', 1], ['id_padre', $id] ])->get();
            foreach ($registros as $key => $value) {
                $clave = $value["id"];

                $query   = "UPDATE " .$this->base ."cat_estructuras SET activo = 0 ";
                $query  .= "WHERE id = " .$clave;
                $estructura = DB::select($query);

                // id_estructura en estructuras responsables
                $query   = "UPDATE " .$this->base ."cat_estructuras_responsables SET activo = 0 ";
                $query  .= "WHERE id_estructura = " .$clave;
                $estructura = DB::select($query);
            }

            return $this->resp_correcta('Aviso', "Área eliminada con éxito");

        } catch (\Exception $e) {
            return $this->resp_error('Aviso', "Ocurrió un error al eliminar el área", "", [
                "e" => $e->getMessage()
            ]);
        }
    }

    public function reordena(Request $request) {
        $nuevo  = $request->newpos;     // 1 = 3
        $old    = $request->oldpos;     // 4 = 6
        $id_est = $request->id;

        $nuevo1 = $nuevo +2;
        $old1   = $old +2;

        $orden = ($nuevo < $old) ? 1 : 0;       // 1. menor, 2. mayor

        if ($orden == 1) {
            $registros = Estructuras::where([ ['activo', 1], ['id_estructura', $id_est], ['id_padre', '!=', 0] ])
                        ->whereRaw('consecutivo >= ' .$nuevo1 .' AND consecutivo <= ' .$old1)
                        ->orderBy('consecutivo', 'asc')
                        ->get();
            $arreglo = [];      // 2,3,4,5,6
            $ultimo  = 0;
            foreach ($registros as $key => $value) {
                $ultimo = $value->cve_t_estructura;
                $arreglo [] = $ultimo;
            }

            $query   = "UPDATE " .$this->base ."02_t_estructura SET consecutivo = 99 ";
            $query  .= " WHERE cve_t_estructura = " .$ultimo;
            $estructura = DB::select($query);
            $indice = $nuevo1;
            for($i = 0; $i < count($arreglo); $i ++) {
                $indice ++;
                $query   = "UPDATE " .$this->base ."02_t_estructura SET consecutivo = " .$indice;
                $query  .= " WHERE cve_t_estructura = " .$arreglo[$i];
                $estructura = DB::select($query);
            }
            $query   = "UPDATE " .$this->base ."02_t_estructura SET consecutivo = " .$nuevo1;
            $query  .= " WHERE cve_t_estructura = " .$ultimo;
            $estructura = DB::select($query);
        }
        else {
            $registros = Estructuras::where([ ['activo', 1], ['id_estructura', $id_est], ['id_padre', '!=', 0] ])
                        ->whereRaw('consecutivo >= ' .$old1 .' AND consecutivo <= ' .$nuevo1)
                        ->orderBy('consecutivo', 'asc')
                        ->get();
            $arreglo = [];      // 2,3,4,5,6
            $primero  = 0;
            foreach ($registros as $key => $value) {
                if ($primero == 0)
                    $primero = $value->cve_t_estructura;
                $numero = $value->cve_t_estructura;
                $arreglo [] = $numero;
            }

            $query   = "UPDATE " .$this->base ."02_t_estructura SET consecutivo = 99 ";
            $query  .= " WHERE cve_t_estructura = " .$primero;
            $estructura = DB::select($query);
            $indice = $old1;
            for($i = 1; $i < count($arreglo); $i ++) {
                $query   = "UPDATE " .$this->base ."02_t_estructura SET consecutivo = " .$indice;
                $query  .= " WHERE cve_t_estructura = " .$arreglo[$i];
                $estructura = DB::select($query);
                $indice ++;
            }
            $query   = "UPDATE " .$this->base ."02_t_estructura SET consecutivo = " .$nuevo1;
            $query  .= " WHERE cve_t_estructura = " .$primero;
            $estructura = DB::select($query);
        }

        return true;
    }



    public function llena_combos ($cual = 1, $valor = 1, $valor1 = 0) {
        $data = null;
        if ($cual == 1) {
            $data   = DistritoFederal::where('activo', 1)
                    ->get();
        }
        if ($cual == 2) {
            $query  = 'SELECT dl.id, dl.valor, dl.cve_03_cat_municipio, mun.valor as nombre ';
            $query .= 'FROM 03_cat_distritoLocal AS dl ';
            $query .= 'JOIN 03_cat_distritoFederal AS df ON df.id = dl.cve_03_cat_distritoFederal ';
            $query .= 'JOIN 03_cat_municipio AS mun ON mun.id = dl.cve_03_cat_municipio ';
            $query .= 'WHERE dl.activo = 1 ';
            if ($valor > 0)
                $query .= 'AND dl.cve_03_cat_distritoFederal =' .$valor;

            $data = DB::select($query);
        }
        if ($cual == 3) {
            $data   = Zona::where('activo', 1)
                    ->get();
        }
        if ($cual == 4) {
            $data   = Seccion::where([ ['activo', 1], ['cve_03_cat_distritoLocal', $valor] ])
                    ->get();
        }

        if ($cual == 5) {
            $data   = EstructurasNiveles::where([ ['activo', 1], ['nivel', 4], ['id_estructura', $valor] ])
                    ->get();
        }
        if ($valor1 > 0) {
            $regresa = 0;
            if ($cual == 5) {
                $regresa = Seccion::where([ ['activo', 1], ['id', $valor1] ])->value('valor');
            }
            else {
                foreach ($data as $key => $value) {
                    $regresa = ($value->id == $valor1) ? $value->valor : $regresa;
                }
            }
            return $regresa;
        }
        else {
            // desglosa los valores

            // Personalizado
            if($cual == 5) {
                $arreglo = [];
                foreach ($data as $key => $value) {
                    $texto = Seccion::where([ ['activo', 1], ['id', $value->valor_hijo] ])->value('valor');
                    $arreglo [] = [ 'id' => $value->valor_hijo, 'valor' => $texto ];
                }
                $data = collect($arreglo);
            }
        }
        return $data;
    }



    public function buscaNivel($nivel, $dl, $valor) {
        $reg = CatTipoCampos::find($nivel);
        $nombre = $this->llena_combos ($nivel, $dl, $valor);
        return $nombre;

    }


    public function buscaResponsable($id, $opcion) {
        $nombre = '...';

        $reg = EstructurasResponsables::where([ ['activo', 1], ['cve_t_estructura_nivel', $id], ['id_titular', 1] ])->get();
        if($reg) {
            foreach ($reg as $key => $value) {
                if ($opcion == 0) {
                    $persona = Ciudadano::find($value->cve_t_ciudadano);
                    if($persona)
                        $nombre = $persona->nombre .' ' .$persona->paterno .' ' .$persona->materno;
                }
                else {
                    $resp = CatResponsabilidades::find($value->cve_t_responsabilidad);
                    $nombre = $resp->responsabilidad;
                }
            }
        }
        return $nombre;
    }


    public function buscaPersona(Request $request) {
        $valor = $request->q;
        $tipo = $request->tipo;

        $reg = Ciudadano::where('activo', 1);
        $reg->whereRaw("curp LIKE '%" .$valor ."%' OR CONCAT(nombre, ' ', paterno, ' ', materno) LIKE '%" .$valor ."%'");
/*
        if($tipo == 0) // CURP
            $reg->whereRaw("curp LIKE '%" .$valor ."%'");
        if($tipo == 1) // Nombre
            $reg->whereRaw("CONCAT(nombre, ' ', paterno, ' ', materno) LIKE '%" .$valor ."%'");
        if($tipo == 3) // Clave elector
            $reg->whereRaw("curp LIKE '%" .$valor ."%'");
*/
        $reg->limit(15);
        $registros = $reg->get();

        $data = [];
        foreach ($registros as $key => $value) {
            $nombre_completo = $value->nombre .' ' .$value->paterno .' ' .$value->materno;
            $data [] = [ 'id' => $value->cve_t_ciudadano, 'text' => $nombre_completo, 'curp' => $value->curp,
                        'clave' => '', 'id_titular' => $value->id_titular
                        ];
        }
        return $data;
    }


}
