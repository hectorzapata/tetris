<?php

namespace Modules\Estructuras\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Estructuras\Entities\Estructuras;
use Modules\Estructuras\Entities\EstructurasNiveles;
use Modules\Estructuras\Entities\EstructurasResponsables;

use Modules\Estructuras\Entities\CatEstados;
use Modules\Estructuras\Entities\CatTipoCampos;

use Modules\Estructuras\Entities\CatDistritosFederales;

// Globales
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use App\User;
use Auth;

// Cargar controlador (llamar a funcion de este controlador)
use Modules\Estructuras\Http\Controllers\GeneralesController;

class EstructurasController extends Controller {

    public $_generales;

    public function __construct() {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set ('America/Mexico_City');
        \DB::statement("SET lc_time_names = 'es_ES'");

        $this->_generales = new GeneralesController();
    }

    public function index() {
        $data = [];

        return view('estructuras::index')->with($data);
    }


    public function store(Request $request) {
        $datos  = $request->all();
        $mensaje = 'Estructura registrada con éxito';

        $id     = ((int) $datos['id_registro'] == 0) ? 0 : (int) $datos['id_registro'];
        $palabra = ($id == 0) ? 'crear' : 'actualizar';

        // busca valores
        $reg = Estructuras::find($datos['cve_t_estructura']);
        $datos['id_estructura'] = $reg->id_estructura;
        $datos['id_padre'] = $reg->id_padre;
        $datos['nivel'] = $reg->nivel;
        $datos['consecutivo'] = $reg->consecutivo;
        $datos['meta'] = isset($datos['meta']) ? $datos['meta'] : 0;
        $datos['valor'] = $datos['comboPadre'];
        if(isset($datos['todo_nivel']))
            $datos['todo_nivel'] = ($datos['todo_nivel'] == 'on') ? 1 : 0;

        if(isset($datos['comboHijo']))
            $datos['valor_hijo'] = $datos['comboHijo'];
        else {
            $datos['valor_hijo'] = isset($datos['txtHijo']) ? $datos['txtHijo'] : 0;
            if($datos['nivel'] == 4) {
                $datos['valor_hijo'] = $datos['comboPadre'];
                $datos['valor'] = $datos['valor_est'];
            }
        }


        try {
            $datos ['cve_usuario'] = Auth::user()->id;

            if ($id == 0)
                $estructura = EstructurasNiveles::create( $datos );
            else {
                $estructura = EstructurasNiveles::find($id);
                $estructura->fill($datos);
                $estructura->save();
            }

            flash($mensaje)->success();
            return redirect('/estructuras');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error al intentar " .$palabra ." la estructura";
            switch ($e->getCode()) {
            case '23000':
                $mensaje = "Lo sentimos, ya existe una estructura registrada con este nombre";
                break;
            }
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }

    public function tabla(Request $request){
        $estructuras = Estructuras::where([ ['activo', 1], ['id_padre', 0] ])->get();

        $datatable = DataTables::of($estructuras)
            ->editColumn('tiene_niveles', function ($estructuras) {
                $id_estructura = $estructuras->id_estructura;
                $valor = Estructuras::where([ ['activo', 1], ['id_estructura', $id_estructura] ])->count();
                return ($valor > 1) ? 1 : 0;
            })
            ->editColumn('fecha_creacion', function ($estructuras) {
                return $estructuras->fecha_creacion ? ucwords(Carbon::parse($estructuras->fecha_creacion)->formatLocalized('%d %B %Y')) : '';
            })
            ->make(true);


        $data = $datatable->getData();
        foreach ($data->data as $key => $value) {
            $acciones = [
                "Editar" => [
                    "icon" => "edit blue",
                    "href" => "configurar/$value->cve_t_estructura/edit"
                ],
                "Eliminar" => [
                    "icon" => "trash red",
                    "onclick" => "eliminar(1,$value->cve_t_estructura)"
                ],
                "Agregar nivel" => [
                    "icon" => "plus green",
                    "href" => "configurar/niveles/$value->cve_t_estructura"
                ]
            ];

            // if ( !permiso('02', 'Editar') ) {
            //     unset($acciones['Editar']);
            // }

            // Si tiene niveles no se permite eliminar
            $tiene = Estructuras::where([ ['activo', 1], ['id_estructura', $value->id_estructura] ])->count();
            if ( !permiso('02', 'Eliminar') && $tiene > 1) {
                unset($acciones['Eliminar']);
            }

            $value->acciones = generarDropdown($acciones);
        }
        $datatable->setData($data);
        return $datatable;
    }



    public function llena_tabla($id) {
        $estructuras    = EstructurasNiveles::where([ ['activo', 1], ['cve_t_estructura', $id] ])
                        ->get();

        $datatable = DataTables::of($estructuras)
            ->editColumn('padre', function ($estructuras) {
                if ($estructuras->nivel == 5)
                    $valor = $this->_generales->buscaNivel(5, 0, $estructuras->valor);
                else
                    $valor = $estructuras->valor;
                return $valor;
            })
            ->editColumn('hijo', function ($estructuras) {
                if ($estructuras->nivel == 5)
                    $valor = $estructuras->valor_hijo;
                else {
                    $buscar = ($estructuras->valor_hijo) ? $estructuras->valor_hijo : $estructuras->valor;
                    $valor = $this->_generales->buscaNivel($estructuras->nivel, $estructuras->valor, $buscar);
                }
                return $valor;
            })
            ->editColumn('nom_responsable', function ($estructuras) {
                $valor = $this->_generales->buscaResponsable($estructuras->cve_t_estructura_nivel, 0);
                return $valor;
            })
            ->editColumn('responsabilidad', function ($estructuras) {
                $valor = $this->_generales->buscaResponsable($estructuras->cve_t_estructura_nivel, 1);
                return $valor;
            })
            ->make(true);


        $data = $datatable->getData();
        foreach ($data->data as $key => $value) {
            $acciones = [
                "Editar" => [
                    "icon" => "edit blue",
                    "onclick" => "editar($id,$value->cve_t_estructura_nivel,$value->nivel)"
                ],
                "Eliminar" => [
                    "icon" => "trash red",
                    "onclick" => "eliminar($id,$value->cve_t_estructura_nivel)"
                ],
                "Agregar responsable" => [
                    "icon" => "plus green",
                    "href" => "estructuras/responsables/$id/$value->cve_t_estructura_nivel"
                ],
                "Quitar responsable" => [
                    "icon" => "plus green",
                    "onclick" => "elimina_responsable($id,$value->cve_t_estructura_nivel)"
                ],
            ];

            // if ( !permiso('02', 'Editar') ) {
            //     unset($acciones['Editar']);
            // }

            if ( $value->nom_responsable == '...' ) {
                unset($acciones['Quitar responsable']);
            }

            $value->acciones = generarDropdown($acciones);
        }
        $datatable->setData($data);

        return $datatable;
    }



    public function datos_registro($id) {
        $data = [];

        $data['estructura'] = EstructurasNiveles::find($id);
        return $data;
    }

}
