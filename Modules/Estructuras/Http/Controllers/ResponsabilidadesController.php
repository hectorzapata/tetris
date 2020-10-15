<?php

namespace Modules\Estructuras\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Estructuras\Entities\CatResponsabilidades;

// Globales
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use App\User;
use Auth;

class ResponsabilidadesController extends Controller {

    public function __construct() {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set ('America/Mexico_City');
        \DB::statement("SET lc_time_names = 'es_ES'");
    }

    public function index() {
        return view('estructuras::responsabilidades.index');
    }

    public function create() {
        return view('estructuras::responsabilidades.create');
    }

    public function edit($id) {
        $data = [];

        try {
            $data ['responsabilidad'] = CatResponsabilidades::find($id);

            return view('estructuras::responsabilidades.create')->with($data);
        } catch (\Exception $e) {
            flash('Lo sentimos, ha ocurrido un error al intentar editar la responsabilidad')->warning();
            return back();
        }

    }


    public function store(Request $request) {
        $datos  = $request->all();
        $mensaje = 'Responsabilidad registrada con éxito';

        try {
            $datos ['cve_usuario'] = Auth::user()->id;

            $responsabilidad = CatResponsabilidades::create( $datos );

            flash($mensaje)->success();
            return redirect('/estructuras/responsabilidades');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error al intentar guardar la responsabilidad";
            switch ($e->getCode()) {
            case '23000':
                $mensaje = "Lo sentimos, ya existe una responsabilidad registrada con este nombre";
                break;
            }
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }

    public function update(Request $request, $id) {
        $datos = $request->all();

        try {
            $datos ['cve_usuario'] = Auth::user()->id;

            $responsabilidad = CatResponsabilidades::find($id);
            $responsabilidad->fill($datos);
            $responsabilidad->save();

            flash('Responsabilidad actualizada con éxito')->success();
            return redirect('/estructuras/responsabilidades');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar la responsabilidad";
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }


    public function destroy($id) {
        try {
            $responsabilidad = CatResponsabilidades::find($id);
            $responsabilidad->activo = 0;
            $responsabilidad->save();

            flash('Responsabilidad eliminada con éxito')->success();
            return redirect('/estructuras/responsabilidades');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error  al eliminar la responsabilidad";
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }


    public function tabla(Request $request){
        $estructuras = CatResponsabilidades::where('activo', 1)->get();

        $datatable  = DataTables::of($estructuras)
                    ->make(true);

        $data = $datatable->getData();
        foreach ($data->data as $key => $value) {
            $acciones = [
                "Editar" => [
                    "icon" => "edit blue",
                    "href" => "/estructuras/responsabilidades/$value->cve_cat_responsabilidad/edit"
                ],
                "Eliminar" => [
                    "icon" => "trash red",
                    "onclick" => "eliminar($value->cve_cat_responsabilidad)"
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
