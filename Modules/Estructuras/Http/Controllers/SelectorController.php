<?php

namespace Modules\Estructuras\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

use \Modules\Estructuras\Entities\Estructuras;
use \Modules\Estructuras\Entities\EstructurasNiveles;
use \Modules\Estructuras\Entities\EstructurasResponsables;


// Catalogos
use \Modules\Catalogos\Entities\DistritoFederal;
use \Modules\Catalogos\Entities\DistritoLocal;
use \Modules\Catalogos\Entities\Zona;
use \Modules\Catalogos\Entities\Seccion;
use \Modules\Catalogos\Entities\Entidad;

use \Modules\Registro\Entities\Ciudadano;

// Globales
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use App\User;
use Auth;

// Cargar controlador (llamar a funcion de este controlador)
use \Modules\Estructuras\Http\Controllers\GeneralesController;

class SelectorController extends Controller {

    public $_generales;

    public function __construct() {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set ('America/Mexico_City');
        \DB::statement("SET lc_time_names = 'es_ES'");

        $this->_generales = new GeneralesController();
    }

    public function estructura($nivel, $params = []) {
        $data = [];

        if ($nivel == 0)
            $reg = Estructuras::where('activo', 1)->get();

        $data ['estructuras'] = $reg;

        return view('estructuras::selector.estructura')->with($data);
    }

    public function llena_combos_valores (Request $request) {
        $opcion = $request->opcion;
        $id_est = $request->id_est;
        $valor = $request->valor;
        $valor1 = $request->valor1;

        $data = [];
        $query   = EstructurasNiveles::where([ ['activo', 1], ['nivel', $opcion], ['id_estructura', $id_est] ]);
        if($valor > 0 && $opcion == 5)
            $query->where('valor', $valor);
        $regs = $query->get();

        foreach ($regs as $key => $value) {
            if($opcion == 1)
                $nombre = DistritoFederal::where([ ['activo', 1], ['id', $value->valor] ])->value('valor');
            if($opcion == 2)
                $nombre = DistritoLocal::where([ ['activo', 1], ['id', $value->valor] ])->value('valor');
            if($opcion == 3)
                $nombre = Zona::where([ ['activo', 1], ['id', $value->valor] ])->value('valor');
            if($opcion == 4)
                $nombre = Seccion::where([ ['activo', 1], ['id', $value->valor_hijo] ])->value('valor');
            if($opcion == 5)
                $nombre = $value->valor_hijo;

            $data [] = [ 'id' => $value->cve_t_estructura_nivel, 'nombre' => $nombre ];
        }
        return $data;
    }


    public function ubica_valores($id) {
        $data = null;

        $registros = EstructurasNiveles::where([ ['activo', 1], ['cve_t_estructura_nivel', $id] ])->get();;
        if($registros) {
            $data = [];
            $val_seccion = 0;
            $valores    = [];
            $id_estructura = 0;

            foreach ($registros as $key => $registro) {
                if ($registro->nivel == 5) {
                    $val_seccion   = Seccion::where([ ['activo', 1], ['id', $registro->valor] ])->value('valor');
                }
                $id_estructura = $registro->cve_t_estructura;

                $valores [] = [
                                'cve_t_estructura_nivel' => $id,
                                'cve_t_estructura' => $id_estructura,
                                'id_estructura' => $registro->id_estructura,
                                'valor' => $registro->valor,
                                'valor_hijo' => $registro->valor_hijo,
                                'valor_anterior' => $val_seccion,
                                'nivel' => $registro->nivel,
                                'id_padre' => $registro->id_padre
                            ];
            }
            $data ['valores'] = $valores;
            $data ['estructura'] = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $id_estructura] ])->get();
        }
        return $data;
    }

    public function _estructura_seleccionada($opcion, $clave) {
        $data = $this->ubica_valores($clave);

        $estructura = $data ['estructura'];
        foreach ($estructura as $key => $value) {
            $reg = Estructuras::where([ ['activo', 1], ['id_estructura', $value->id_estructura], ['id_padre', 0] ])->get();
            foreach ($reg as $key1 => $value1) {
                $nombre_estructura = $value1->nombre_estructura;
                $nombre_distrito = $value1->distrito_federal;
                $nombre_estado = Entidad::where([ ['activo', 1], ['id', $value1->cve_estado] ])->value('valor');
            }
        }

        // desglosa valores
        //
        $valores = $data ['valores'];

        $nombre_nivel = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $valores[0]['cve_t_estructura']],
                                            ['id_estructura', $valores[0]['id_estructura']]
                                    ])->value('descripcion');

        $lblUno = $nombre_nivel;
        $nivel = $valores[0]['nivel'];

        $lblDos = '';
        $valorDos = '';

        if ($nivel == 1)
            $valorUno   = DistritoFederal::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');

        if ($nivel == 2)
            $valorUno   = DistritoLocal::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');

        if ($nivel == 3)
            $valorUno   = Zona::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');

        if ($nivel == 4) {
            $valorUno   = Seccion::where([ ['activo', 1], ['id', $valores[0]['valor_hijo']],
                                                ['cve_03_cat_distritoLocal', $valores[0]['valor']]
                                            ])->value('valor');
        }

        if ($nivel == 5) {
            $valorUno   = Seccion::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');
            $lblUno     = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $valores[0]['id_padre']],
                                                ['id_estructura', $valores[0]['id_estructura']]
                                        ])->value('descripcion');
            $lblDos = $nombre_nivel;
            $valorDos = $valores[0]['valor_hijo'];
        }


        if($opcion == 1) {
            $data = [];
            $data ['label_estructura'] = 'Estructura';
            $data ['valor_estructura'] = $nombre_estructura;
            $data ['label_distrito'] = 'Distrito Federal';
            $data ['valor_distrito'] = $nombre_distrito;
            $data ['label_estado'] = 'Estado';
            $data ['valor_estado'] = $nombre_estado;

            $data ['label_uno'] = $lblUno;
            $data ['valor_uno'] = $valorUno;
            $data ['label_dos'] = $lblDos;
            $data ['valor_dos'] = $valorDos;

            return $data;

        }
        else {
            $t  = <<<EOT
                <div class="row form-group" >
                    <div class="col-sm-6">
                        <label class="label-form w100">Nombre de la Estructura</label>
                        <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_estructura" />
                    </div>
                    <div class="col-sm-3">
                        <label class="label-form">Dist. Federal </label>
                        <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_distrito" />
                    </div>
                    <div class="col-sm-3">
                        <label class="label-form">Estado </label>
                        <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_estado" />
                    </div>
                </div>

                <!-- seleccion de valores -->
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label class="label-form w100">Nombre del nivel </label>
                        <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_nivel" />
                    </div>
                    <div class="col-sm-3" id="ctrlUno">
                        <label class="label-form w100">$lblUno </label>
                        <input type="text" class="form-control p-3" disabled="disabled" value="$valorUno" />
                    </div>
                    <div class="col-sm-3" id="ctrlDos">
                        <label class="label-form w100">$lblDos </label>
                        <input type="text" class="form-control p-3" disabled="disabled" value="$valorDos" />
                    </div>
                </div>
            EOT;

            return $t;
        }
    }



    public function exporta_xls ($id) {
        $data = [];
        $registros = EstructurasAreas::where([ ['activo', 1], ['cve_t_estructura', $id] ])
                    ->orderBy('nivel', 'asc')
                    ->orderBy('consecutivo', 'asc')
                    ->orderBy('cve_t_estructura_nivel', 'asc')
                    ->get();

        foreach ($registros as $key => $value) {
            $datos = _estructura_seleccionada(1, $value->cve_t_estructura_nivel);


            $datos ['label_estructura'] = 'Estructura';
            $datos ['valor_estructura'] = $nombre_estructura;
            $datos ['label_distrito'] = 'Distrito Federal';
            $datos ['valor_distrito'] = $nombre_distrito;
            $datos ['label_estado'] = 'Estado';
            $datos ['valor_estado'] = $nombre_estado;

            $datos ['label_uno'] = $lblUno;
            $datos ['valor_uno'] = $valorUno;
            $datos ['label_dos'] = $lblDos;
            $datos ['valor_dos'] = $valorDos;


            $data [] = [
                            'id' => $value->cve_t_estructura_nivel,
                            'estructura' => $datos ['valor_estructura'],
                            'distrito' => $datos ['valor_distrito'],
                            'estado' => $datos ['valor_estado'],
                            'origen_padre' => $datos ['label_uno'],
                            'valor_padre' => $datos ['valor_uno'],
                            'nivel' => $datos ['label_dos'],
                            'valor' => $datos ['valor_dos'],

                            'meta' => $value->meta,
                            'valor' => $datos ['valor_dos'],
                            'valor' => $datos ['valor_dos'],
                            'valor' => $datos ['valor_dos'],
                            'valor' => $datos ['valor_dos'],
                        ];
        }
        return $data;
    }


    public function llena_responsables (Request $request) {
        $id = $request->filtro;
        $regs = EstructurasResponsables::where([ ['activo', 1], ['cve_t_estructura_nivel', $id] ])
                    ->orderBy('cve_t_responsabilidad', 'asc')
                    ->get();
        $data = [];
        foreach ($regs as $key => $value) {
            $reg = Ciudadano::find($value->cve_t_ciudadano);
            if ($reg) {
                $nombre = ($reg) ? $reg->nombre .' ' .$reg->paterno .' ' .$reg->materno : '...';
                $data [] = [
                                'id_responsable' => $value->cve_t_estructura_responsable,
                                'nombre' => $nombre,
                                'responsabilidad' => $value->obtResponsabilidad->responsabilidad,
                                'id_titular' => $value->id_titular
                            ];
            }
        }
        return $data;
    }
}
