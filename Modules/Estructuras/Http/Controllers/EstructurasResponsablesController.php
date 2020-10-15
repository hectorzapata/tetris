<?php

namespace Modules\Estructuras\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Estructuras\Entities\Estructuras;
use Modules\Estructuras\Entities\EstructurasNiveles;
use Modules\Estructuras\Entities\EstructurasResponsables;
use Modules\Estructuras\Entities\CatResponsabilidades;

// Catalogos
use Modules\Catalogos\Entities\DistritoFederal;
use Modules\Catalogos\Entities\DistritoLocal;
use Modules\Catalogos\Entities\Zona;
use Modules\Catalogos\Entities\Seccion;


// Globales
use App\Classes\Notificaciones;
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use App\User;
use Auth;

// Cargar controlador (llamar a funcion de este controlador)
use Modules\Estructuras\Http\Controllers\GeneralesController;
use Modules\Estructuras\Http\Controllers\SelectorController;

class EstructurasResponsablesController extends Controller {

    public $_generales;
    use Notificaciones;

    public function __construct() {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set ('America/Mexico_City');
        \DB::statement("SET lc_time_names = 'es_ES'");

        $this->_generales = new GeneralesController();
        $this->_selector = new SelectorController();
    }

    public function index($id, $clave) {
        $data = [];
        $data['nombre_completo'] = '--';
        $data['estructura_nivel'] = $clave;
        $data['responsabilidades'] = CatResponsabilidades::where([ ['activo', 1], ['id_tipo', 1] ])
                                    ->select('cve_cat_responsabilidad', 'responsabilidad')
                                    ->get();

        $data['estructura_seleccionada'] = $this->_selector->_estructura_seleccionada(0, $clave);

        return view('estructuras::responsables.index')->with($data);
    }

    public function create() {
        return view('estructuras::responsables.create');
    }

    public function edit($id) {
        $data = [];

        try {
            $data ['responsable'] = EstructurasResponsables::find($id);

            return view('estructuras::responsables.create')->with($data);
        } catch (\Exception $e) {
            flash('Lo sentimos, ha ocurrido un error al intentar editar al responsable')->warning();
            return back();
        }

    }


    public function store(Request $request) {
        $datos  = $request->all();
        $msg_existe = null;

        try {
            $datos ['cve_usuario'] = Auth::user()->id;

            if($datos ['id_titular'] == 1) {
                $existe = EstructurasResponsables::where([ ['activo', 1], ['id_titular', 1], ['cve_t_estructura_nivel', $datos['cve_t_estructura_nivel']] ])
                        ->value('cve_t_estructura_responsable');
                if($existe) {
                    $datos ['id_titular'] = 0;
                    $msg_existe = 'Ya existe una persona que es titular del nivel';
                }
            }
            // valida existencia de persona
            $persona = EstructurasResponsables::where([ ['activo', 1], ['cve_t_estructura_nivel', $datos['cve_t_estructura_nivel']],
                                                        ['cve_t_ciudadano', $datos['cve_t_ciudadano']]
                                                    ])->value('cve_t_estructura_responsable');

            if ($persona)
                return $this->notificacion_('error', "Aviso", "Esta persona ya se encuentra registrada en este nivel");
            else {
                $responsable = EstructurasResponsables::create( $datos );
                return $this->notificacion_('success', "Aviso", "Responsable registrado con éxito", [ 'existe' => $msg_existe ]);
            }

        } catch (\Exception $e) {
            return $this->notificacion_('error', "Aviso", "Ha ocurrido un error al guardar al responsable", [
                'error_msg' => $e->getMessage(), 'error_code' => $e->getCode(), 'delay' => 4000
            ]);
        }
    }

    public function update(Request $request, $id) {
        $datos = $request->all();

        try {
            $datos ['cve_usuario'] = Auth::user()->id;

            $responsable = EstructurasResponsables::find($id);
            $responsable->fill($datos);
            $responsable->save();

            flash('Responsable actualizada con éxito')->success();
            return redirect('/estructuras/responsables');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar el responsable";
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }


    public function destroy($id) {
        try {
            $responsable = EstructurasResponsables::find($id);
            $responsable->activo = 0;
            $responsable->save();

            flash('Responsable eliminada con éxito')->success();
            return redirect('/estructuras/responsables');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error  al eliminar el responsable";
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }


    public function tabla($id){
        $responsable = EstructurasResponsables::where([ ['activo', 1], ['cve_t_estructura_nivel', $id] ])
                    ->orderBy('cve_t_responsabilidad', 'asc')
                    ->get();

        $datatable = DataTables::of($responsable)
        ->editColumn('cve_t_ciudadano', function ($responsable) {
            $nombre = $responsable->obtValores(1, $responsable->cve_t_ciudadano);
            return $nombre;
        })
        ->editColumn('cve_t_responsabilidad', function ($responsable) {
            $nombre = $responsable->obtResponsabilidad->responsabilidad;
            return $nombre;
        })
        ->editColumn('curp', function ($responsable) {
            $nombre = $responsable->obtValores(2, $responsable->cve_t_ciudadano);
            return $nombre;
        })
        ->editColumn('clave', function ($responsable) {
            $nombre = $responsable->obtValores(3, $responsable->cve_t_ciudadano);
            return $nombre;
        })
        ->make(true);


        $data = $datatable->getData();
        foreach ($data->data as $key => $value) {
            $acciones = [
                "Editar" => [
                    "icon" => "edit blue",
                    "onclick" => "modificar(1,$value->cve_t_estructura_responsable)"
                ],
                "Eliminar" => [
                    "icon" => "trash red",
                    "onclick" => "eliminar(1,$value->cve_t_estructura_responsable)"
                ]
            ];

            // if ( !permiso('02', 'Editar') ) {
            //     unset($acciones['Editar']);
            // }

            $value->acciones = generarDropdown($acciones);
        }
        $datatable->setData($data);
        return $datatable;
    }


}
