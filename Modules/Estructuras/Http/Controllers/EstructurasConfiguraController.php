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
use App\Classes\Notificaciones;
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use App\User;
use Auth;

// Cargar controlador (llamar a funcion de este controlador)
use Modules\Estructuras\Http\Controllers\GeneralesController;

class EstructurasConfiguraController extends Controller {

    public $_generales;

    use Notificaciones;

    public function __construct() {
        setlocale(LC_ALL, 'es_ES');
        date_default_timezone_set ('America/Mexico_City');
        \DB::statement("SET lc_time_names = 'es_ES'");

        $this->_generales = new GeneralesController();
    }

    public function index() {
        return view('estructuras::configurar.index');
    }


    public function create() {
        $data = [];
        $data ['estados'] = CatEstados::where('activo', 1)->get();
        $data ['tipocampos'] = CatTipoCampos::where('activo', 1)->get();

        $data ['distritos_federales'] = CatDistritosFederales::where('activo', 1)->get();

        $data['cve_t_estructura'] = 0;
        $data['nombre_estructura'] = '';

        return view('estructuras::configurar.create')->with($data);
    }


    public function store(Request $request) {
        $datos = $request->all();
        $mensaje = 'Estructura registrada con éxito';

        $nueva = 0;
        $palabra = ($nueva == 0) ? 'crear' : 'actualizar';

        $datos['id_padre'] = 0;
        $datos['nivel'] = 0;
        $datos['consecutivo'] = 1;

        try {
            $datos ['cve_usuario'] = Auth::user()->id;

            if ($nueva == 0)
                $estructura = Estructuras::create( $datos );
            else {
                $estructura = Estructuras::find($id);
                $estructura->fill($datos);
                $estructura->save();
            }
            $id_estructura = $estructura->cve_t_estructura;

            if($nueva == 0) {
                $estructura->id_estructura = $id_estructura;
                $estructura->save();
            }

            flash($mensaje)->success();
            return redirect('/estructuras/configurar');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error al intentar " .$palabra ." la estructura";
            switch ($e->getCode()) {
            case '23000':
                $mensaje = "Lo sentimos, ya existe una estructura registrada con este nombre " . $request->nombre_estructura;
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

            $estructura = Estructuras::find($id);
            $estructura->fill($datos);
            $estructura->save();

            flash('Estructura actualizada con éxito')->success();
            return redirect('/estructuras/configurar');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar la estructura";
            switch ($e->getCode()) {
            case '23000':
                $mensaje = "Lo sentimos, ya existe una estructura registrada con este nombre " . $request->nombre_estructura;
                break;
            }
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }

    public function show($id) {
        $data = [];

        return view('estructuras::configurar.show')->with($data);
    }


    public function edit($id) {
        $data = [];

        try {
            $data ['estados'] = CatEstados::where('activo', 1)->get();
            $data ['tipocampos'] = CatTipoCampos::where('activo', 1)->get();

            $data ['distritos_federales'] = CatDistritosFederales::where('activo', 1)->get();
            $data ['estructura'] = Estructuras::find($id);
            $data ['niveles_existentes'] = $this->_generales->lista_niveles($id, 1);

            $data['cve_t_estructura'] = $id;

            return view('estructuras::configurar.create')->with($data);
        } catch (\Exception $e) {
          flash('Lo sentimos, ha ocurrido un error al intentar editar la estructura')->warning();
          return back();
        }

    }


    public function destroy($id) {
        try {
            $estructura = Estructuras::find($id);
            $estructura->activo = 0;
            $estructura->save();

            flash('Estructura eliminada con éxito')->success();
            return redirect('/estructuras/configurar');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error  al eliminar la estructura";
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }



    public function create_niveles($id) {
        $data = [];

        try {
            $estructura = Estructuras::find($id);

            $data ['nueva'] = 0;
            $data ['cve_t_estructura'] = $id;
            $data ['tipocampos'] = CatTipoCampos::where('activo', 1)->get();
            $registros = Estructuras::where([ ['activo', 1], ['id_estructura', $id] ])->get();
            $data ['consecutivo']  = $registros->count() +1;

            return view('estructuras::configurar.niveles')->with($data);
        } catch (\Exception $e) {
          flash('Lo sentimos, ha ocurrido un error al intentar editar el nivel')->warning();
          return back();
        }

    }

    public function edit_niveles($id) {
        $data = [];

        try {
            $nivel = EstructurasNiveles::find($id);
            $estructura = Estructuras::find($nivel->cve_t_estructura);
            $data['cve_t_estructura'] = $estructura->cve_t_estructura;
            $data['nombre_estructura'] = $estructura->nombre_estructura;
            $data['nivel'] = $nivel;

            $data ['tipocampos'] = CatTipoCampos::where('activo', 1)->get();
            return view('estructuras::configurar.niveles')->with($data);
        } catch (\Exception $e) {
          flash('Lo sentimos, ha ocurrido un error al intentar editar el nivel')->warning();
          return back();
        }

    }




    // Niveles
    public function store_niveles(Request $request, $id) {
        $datos = $request->all();

        try {
            $datos ['id_estructura'] = $id;
            $datos ['cve_usuario'] = Auth::user()->id;
            $datos['nombre_estructura'] = CatTipoCampos::where([ ['activo', 1], ['cve_cat_tipocampo', $datos['nivel']] ])->value('tipo_campo');

            $estructura = Estructuras::create( $datos );

            flash('Nivel de la estructura creado con éxito')->success();
            return redirect('/estructuras/configurar/niveles/' .$id);

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error crear el nivel de la estructura";
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }


    public function update_niveles(Request $request, $id) {
        $datos = $request->all();

        try {
            $estructura = Estructuras::find($id);
            $estructura->fill($datos);
            $estructura->save();

            flash('Nivel de la estructura actualizado con éxito')->success();
            return redirect('/estructuras/configurar/niveles/' .$id);

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error crear al actualizar el nivel en la estructura";
            flash($mensaje)->warning();
            return back()->withInput($request->input());
        }
    }


    public function destroy_niveles($id) {
        try {
            $estructura = EstructurasNiveles::find($id);
            $estructura->activo = 0;
            $estructura->save();

            flash('Nivel de la estructura eliminado con éxito')->success();
            return redirect('/estructuras/configurar');

        } catch (\Exception $e) {
            $mensaje = "Lo sentimos, ha ocurrido un error crear al eliminar el nivel de la estructura";
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
                ],
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

}
