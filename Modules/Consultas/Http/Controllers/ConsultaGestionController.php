<?php

namespace Modules\Consultas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Catalogos\Entities\DistritoFederal;
use Modules\Catalogos\Entities\DistritoLocal;
use Modules\Catalogos\Entities\Municipio;
use Modules\Catalogos\Entities\Entidad;
use Modules\Catalogos\Entities\Colonia;
use Modules\Catalogos\Entities\CodigoPostal;
use Modules\Catalogos\Entities\Seccion;
use Modules\Catalogos\Entities\Gestor;
use Modules\Catalogos\Entities\TipoGestion;

use Modules\Registro\Entities\Gestiones;
use Modules\Registro\Entities\Estatus_Gestion;


use Modules\Registro\Entities\Registro_Ciudadano;

/////////////////////////////////////////
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use Auth;
use \DB;
class ConsultaGestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['municipio'] = Municipio::where('activo',1)->get();
        $data['registro'] = Registro_Ciudadano::where('activo',1)->get();
        return view('consultas::consulta_gestiones.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('consultas::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('consultas::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('consultas::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
      $gestiones_eliminar = Gestiones::find($request->id_registro);
      $gestiones_eliminar->activo = 0;
      $gestiones_eliminar->save();

      return response()->json(['success'=>'Eliminado exitosamente']);
    }


    public function estatus(Request $request){
      try {


        if ($request->estatus == 2) {



          $estatus_gestion = new Estatus_Gestion();
          $estatus_gestion->cve_t_gestiones = $request->id_gestion;
          $estatus_gestion->estatus = $request->estatus;
          $estatus_gestion->fecha_atendido = $request->fecha_atendido;
          $estatus_gestion->fecha_entregada = $request->fecha_entregada;
          $estatus_gestion->apoyo_otorgado = $request->apoyo_otorgado;
          $estatus_gestion->descripcion_estatus = $request->descripcion_estatus;
          $estatus_gestion->cve_usuario = Auth::user()->id;
          $estatus_gestion->save();

          $edit_gestiones = Gestiones::find($request->id_gestion);
          $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          $edit_gestiones->fecha_entrega = $request->fecha_entregada;
          $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
          $edit_gestiones->estatus = $request->estatus;
          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();

        }elseif($request->estatus == 3){

          $estatus_gestion = new Estatus_Gestion();
          $estatus_gestion->cve_t_gestiones = $request->id_gestion;
          $estatus_gestion->estatus = $request->estatus;
          // $estatus_gestion->fecha_atendido = $request->fecha_atendido;
          // $estatus_gestion->fecha_entregada = $request->fecha_entregada;
          // $estatus_gestion->apoyo_otorgado = $request->apoyo_otorgado;
          $estatus_gestion->descripcion_estatus = $request->descripcion_estatus;
          $estatus_gestion->cve_usuario = Auth::user()->id;
          $estatus_gestion->save();

          $edit_gestiones = Gestiones::find($request->id_gestion);
          // $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          // $edit_gestiones->fecha_entrega = $request->fecha_entregada;
          // $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
          $edit_gestiones->estatus = $request->estatus;
          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();


        }elseif($request->estatus == 4){
          $estatus_gestion = new Estatus_Gestion();
          $estatus_gestion->cve_t_gestiones = $request->id_gestion;
          $estatus_gestion->estatus = $request->estatus;
          // $estatus_gestion->fecha_atendido = $request->fecha_atendido;
          // $estatus_gestion->fecha_entregada = $request->fecha_entregada;
          // $estatus_gestion->apoyo_otorgado = $request->apoyo_otorgado;
          $estatus_gestion->descripcion_estatus = $request->descripcion_estatus;
          $estatus_gestion->cve_usuario = Auth::user()->id;
          $estatus_gestion->save();

          $edit_gestiones = Gestiones::find($request->id_gestion);
          // $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          // $edit_gestiones->fecha_entrega = $request->fecha_entregada;
          // $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
          $edit_gestiones->estatus = $request->estatus;
          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();

        }elseif($request->estatus == 5){
          $estatus_gestion = new Estatus_Gestion();
          $estatus_gestion->cve_t_gestiones = $request->id_gestion;
          $estatus_gestion->estatus = $request->estatus;
          // $estatus_gestion->fecha_atendido = $request->fecha_atendido;
          // $estatus_gestion->fecha_entregada = $request->fecha_entregada;
          // $estatus_gestion->apoyo_otorgado = $request->apoyo_otorgado;
          $estatus_gestion->descripcion_estatus = $request->descripcion_estatus;
          $estatus_gestion->cve_usuario = Auth::user()->id;
          $estatus_gestion->save();

          $edit_gestiones = Gestiones::find($request->id_gestion);
          // $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          // $edit_gestiones->fecha_entrega = $request->fecha_entregada;
          // $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
          $edit_gestiones->estatus = $request->estatus;
          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();
        }

        return response()->json(['success'=>'Se Actualizo con Exito']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }

    }


    public function TablaGestion(Request $request){
    //  dd($request->all());


        if ($request->fecha_entrega_1 == NULL &&  $request->fecha_entrega_2 == NULL ) {

          /////////////////////////////////////////////////////////////////////////////////
          setlocale(LC_TIME, 'es_ES');
          \DB::statement("SET lc_time_names = 'es_ES'");
          //$registro = Registro_Ciudadano::where('activo', '!=', 0);
          //dd("seccion:".$request->seccion,"distrito federal:".$request->distrito_fed,"distrito local:".$request->distrito_loc);
          $registro_query = "

          SELECT
          01_t_gestiones.fecha_recepcion,
          01_t_gestiones.tipo_peticion,
          01_t_gestiones.categoria_peticion,
          01_t_gestiones.gestor,
          01_t_gestiones.descripcion_gestor,
          01_t_gestiones.municipio,
          01_t_gestiones.fecha_atendido,
          01_t_gestiones.apoyo_otorgado,
          01_t_gestiones.estatus,
          01_t_gestiones.cve_t_gestiones
          FROM 01_t_gestiones
          INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_gestiones.cve_t_ciudadano
          INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano =  t_ciudadano.cve_t_ciudadano
          WHERE 01_t_gestiones.activo = 1 and 01_t_registro_ciudadano.cve_t_registro_ciudadano = $request->estructura_id AND 01_t_gestiones.tipo_peticion = $request->tipo_peticion_id AND 01_t_gestiones.estatus = $request->estatus_id AND 01_t_gestiones.municipio = $request->municipio_id
          AND 01_t_gestiones.fecha_recepcion BETWEEN '2020-01-01 00:00:00' AND '2020-12-31 00:00:00'";
          $registro = DB::select($registro_query);



          $datatable = DataTables::of($registro)
          ->editColumn('tipo_peticion', function ($registro) {
            if ($registro->tipo_peticion == 1) {
              $peticion = 'Individual';
            }else{
              $peticion = 'Grupal';
            }

            return $peticion;
          })

          ->editColumn('estatus', function ($registro) {
            if ($registro->estatus == 1) {
              $estatus = 'Registrado';
            }elseif($registro->estatus == 2){
              $estatus = 'Entregada';
            }elseif($registro->estatus == 3){
              $estatus = 'En Proceso';
            }elseif($registro->estatus == 4){
              $estatus = 'Pendiente';
            }elseif($registro->estatus == 5){
              $estatus = 'Cancelada';
            }

            return $estatus;
          })

          ->editColumn('municipio', function ($registro) {


            $municipio = Municipio::where([
              ['activo',1],
              ['id',$registro->municipio]
            ])->first();

            return $municipio->valor;
          })

          ->editColumn('fecha_atendido', function ($registro) {

            if ($registro->fecha_atendido == NULL) {
              $fecha = 'No ha sido Atendido';
            }else{
              $fecha = $registro->fecha_atendido;
            }

            return $fecha;
          })



          ->editColumn('categoria_peticion', function ($registro) {

            $tipogestion = TipoGestion::where([
              ['activo',1],
              ['id',$registro->categoria_peticion]
            ])->first();

            return $tipogestion->valor;
          })

          ->editColumn('gestor', function ($registro) {

            $gestor = Gestor::where([
              ['activo',1],
              ['id',$registro->gestor]
            ])->first();

            return $gestor->valor;
          })
          ->make(true);
          //Cueri
          $data = $datatable->getData();
          foreach ($data->data as $key => $value) {

            if ($value->tipo_peticion == 'Grupal') {
              $acciones = [
                "Editar" => [
                  "icon" => "edit blue",
                  "href" => "/gestiones/$value->cve_t_gestiones/edit"
                ],

                "Ver detalles" => [
                  "icon" => "eye teal",
                  "href" => "/gestiones/$value->cve_t_gestiones/show"
                ],

                "Eliminar" => [
                  "icon" => "trash red",
                  "onclick" => "eliminar('$value->cve_t_gestiones')"
                ],
                "Ver Grupo" => [
                  "icon" => "trash red",
                  "onclick" => "grupo('$value->cve_t_gestiones')"
                ],
                "Actualizar Estatus" => [
                  "icon" => "eye teal",
                  "onclick" => "estatus('$value->cve_t_gestiones')"

                ]
              ];
            }else{
              $acciones = [
                "Editar" => [
                  "icon" => "edit blue",
                  "href" => "/gestiones/$value->cve_t_gestiones/edit"
                ],

                "Ver detalles" => [
                  "icon" => "eye teal",
                  "href" => "/gestiones/$value->cve_t_gestiones/show"
                ],

                "Eliminar" => [
                  "icon" => "trash red",
                  "onclick" => "eliminar('$value->cve_t_gestiones')"
                ],
                "Actualizar Estatus" => [
                  "icon" => "eye teal",
                  "onclick" => "estatus('$value->cve_t_gestiones')"

                ]
              ];
            }




            $value->acciones = generarDropdown($acciones);
          }
          $datatable->setData($data);
          return $datatable;
          ////////////////////////////////////////////////////////////////
        }else{
          ///////////////////////////////////////////////////////////////
          setlocale(LC_TIME, 'es_ES');
          \DB::statement("SET lc_time_names = 'es_ES'");
          //$registro = Registro_Ciudadano::where('activo', '!=', 0);
          //dd("seccion:".$request->seccion,"distrito federal:".$request->distrito_fed,"distrito local:".$request->distrito_loc);
          $registro_query = "

          SELECT
          01_t_gestiones.fecha_recepcion,
          01_t_gestiones.tipo_peticion,
          01_t_gestiones.categoria_peticion,
          01_t_gestiones.gestor,
          01_t_gestiones.descripcion_gestor,
          01_t_gestiones.municipio,
          01_t_gestiones.fecha_atendido,
          01_t_gestiones.apoyo_otorgado,
          01_t_gestiones.estatus,
          01_t_gestiones.cve_t_gestiones
          FROM 01_t_gestiones
          INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_gestiones.cve_t_ciudadano
          INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano =  t_ciudadano.cve_t_ciudadano
          WHERE 01_t_gestiones.activo = 1 and 01_t_registro_ciudadano.cve_t_registro_ciudadano = $request->estructura_id AND 01_t_gestiones.tipo_peticion = $request->tipo_peticion_id AND 01_t_gestiones.estatus = $request->estatus_id AND 01_t_gestiones.municipio = $request->municipio_id
          AND 01_t_gestiones.fecha_recepcion BETWEEN '2020-01-01 00:00:00' AND '2020-12-31 00:00:00'
          AND 01_t_gestiones.fecha_entrega BETWEEN '2020-01-01 00:00:00' AND '2020-12-31 00:00:00'";
          $registro = DB::select($registro_query);



          $datatable = DataTables::of($registro)
          ->editColumn('tipo_peticion', function ($registro) {
            if ($registro->tipo_peticion == 1) {
              $peticion = 'Individual';
            }else{
              $peticion = 'Grupal';
            }

            return $peticion;
          })

          ->editColumn('estatus', function ($registro) {
            if ($registro->estatus == 1) {
              $estatus = 'Registrado';
            }elseif($registro->estatus == 2){
              $estatus = 'Entregada';
            }elseif($registro->estatus == 3){
              $estatus = 'En Proceso';
            }elseif($registro->estatus == 4){
              $estatus = 'Pendiente';
            }elseif($registro->estatus == 5){
              $estatus = 'Cancelada';
            }

            return $estatus;
          })

          ->editColumn('municipio', function ($registro) {


            $municipio = Municipio::where([
              ['activo',1],
              ['id',$registro->municipio]
            ])->first();

            return $municipio->valor;
          })



          ->editColumn('categoria_peticion', function ($registro) {

            $tipogestion = TipoGestion::where([
              ['activo',1],
              ['id',$registro->categoria_peticion]
            ])->first();

            return $tipogestion->valor;
          })

          ->editColumn('fecha_atendido', function ($registro) {

            if ($registro->fecha_atendido == NULL) {
              $fecha = 'No ha sido Atendido';
            }else{
              $fecha = $registro->fecha_atendido;
            }

            return $fecha;
          })

          ->editColumn('gestor', function ($registro) {


            $gestor = Gestor::where([
              ['activo',1],
              ['id',$registro->gestor]
            ])->first();

            return $gestor->valor;
          })


          ->make(true);
          //Cueri
          $data = $datatable->getData();
          foreach ($data->data as $key => $value) {

            if ($value->tipo_peticion == 'Grupal') {
              $acciones = [
                "Editar" => [
                  "icon" => "edit blue",
                  "href" => "/gestiones/$value->cve_t_gestiones/edit"
                ],

                "Ver detalles" => [
                  "icon" => "eye teal",
                  "href" => "/gestiones/$value->cve_t_gestiones/show"
                ],

                "Eliminar" => [
                  "icon" => "trash red",
                  "onclick" => "eliminar('$value->cve_t_gestiones')"
                ],
                "Ver Grupo" => [
                  "icon" => "trash red",
                  "onclick" => "grupo('$value->cve_t_gestiones')"
                ],
                "Actualizar Estatus" => [
                  "icon" => "eye teal",
                  "onclick" => "estatus('$value->cve_t_gestiones')"

                ]
              ];
            }else{
              $acciones = [
                "Editar" => [
                  "icon" => "edit blue",
                  "href" => "/gestiones/$value->cve_t_gestiones/edit"
                ],

                "Ver detalles" => [
                  "icon" => "eye teal",
                  "href" => "/gestiones/$value->cve_t_gestiones/show"
                ],

                "Eliminar" => [
                  "icon" => "trash red",
                  "onclick" => "eliminar('$value->cve_t_gestiones')"
                ],
                "Ver Beneficiario" => [
                  "icon" => "trash red",
                  "onclick" => "beneficiario('$value->cve_t_gestiones')"
                ],
                "Actualizar Estatus" => [
                  "icon" => "eye teal",
                  "onclick" => "estatus('$value->cve_t_gestiones')"

                ]
              ];
            }


            $value->acciones = generarDropdown($acciones);
          }
          $datatable->setData($data);
          return $datatable;
          //////////////////////////////////////////////////////////////
        }



    }


    public function gestiones(Request $request){
      //dd($request->id);


          /////////////////////////////////////////////////////////////////////////////////
          setlocale(LC_TIME, 'es_ES');
          \DB::statement("SET lc_time_names = 'es_ES'");
          //$registro = Registro_Ciudadano::where('activo', '!=', 0);
          //dd("seccion:".$request->seccion,"distrito federal:".$request->distrito_fed,"distrito local:".$request->distrito_loc);
          $registro_query = "

          (SELECT
          t_ciudadano.nombre,
          t_ciudadano.paterno,
          t_ciudadano.materno,
          t_ciudadano.rfc,
          t_ciudadano.curp,
          03_cat_municipio.valor AS municipio,
          t_domicilio.nombre_asentamiento AS colonia,
          t_domicilio.cp

          FROM 01_t_gestiones
          INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_gestiones.cve_t_ciudadano
          INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 03_cat_municipio ON 03_cat_municipio.id = t_domicilio.cve_mun
          WHERE 01_t_gestiones.activo = 1 AND 01_t_gestiones.cve_t_gestiones = $request->id
          )
          UNION
          (
          SELECT
          t_ciudadano.nombre,
          t_ciudadano.paterno,
          t_ciudadano.materno,
          t_ciudadano.rfc,
          t_ciudadano.curp,
          03_cat_municipio.valor AS municipio,
          t_domicilio.nombre_asentamiento AS colonia,
          t_domicilio.cp

          FROM 01_t_beneficiarios
          INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_beneficiarios.cve_t_ciudadano
          INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 03_cat_municipio ON 03_cat_municipio.id = t_domicilio.cve_mun
          WHERE 01_t_beneficiarios.activo = 1 AND 01_t_beneficiarios.cve_t_gestiones = $request->id
          )";

          $registro = DB::select($registro_query);



          $datatable = DataTables::of($registro)
          ->editColumn('nombre', function ($registro) {
            $nombre = $registro->nombre.' '.$registro->paterno.' '.$registro->materno;

            return $nombre;
          })
          ->editColumn('rfc', function ($registro) {

            if ($registro->rfc == null) {
              $rfc = 'Sin Registro';
            }else{
              $rfc = $registro->rfc;
            }

            return $rfc;
          })
          ->make(true);
          //Cueri
          $data = $datatable->getData();
          foreach ($data->data as $key => $value) {

            $acciones = [

            ];




            $value->acciones = generarDropdown($acciones);
          }
          $datatable->setData($data);
          return $datatable;
          ////////////////////////////////////////////////////////////////




    }


    public function beneficiario(Request $request){
          /////////////////////////////////////////////////////////////////////////////////
          setlocale(LC_TIME, 'es_ES');
          \DB::statement("SET lc_time_names = 'es_ES'");
          //$registro = Registro_Ciudadano::where('activo', '!=', 0);
          //dd("seccion:".$request->seccion,"distrito federal:".$request->distrito_fed,"distrito local:".$request->distrito_loc);
          $registro_query = "

          SELECT
          t_ciudadano.nombre,
          t_ciudadano.paterno,
          t_ciudadano.materno,
          t_ciudadano.rfc,
          t_ciudadano.curp,
          03_cat_municipio.valor AS municipio,
          t_domicilio.nombre_asentamiento AS colonia,
          t_domicilio.cp

          FROM 01_t_gestiones
          INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_gestiones.cve_t_ciudadano
          INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 03_cat_municipio ON 03_cat_municipio.id = t_domicilio.cve_mun
          WHERE 01_t_gestiones.activo = 1 AND 01_t_gestiones.cve_t_gestiones = $request->id
          ";

          $registro = DB::select($registro_query);



          $datatable = DataTables::of($registro)
          ->editColumn('nombre', function ($registro) {
            $nombre = $registro->nombre.' '.$registro->paterno.' '.$registro->materno;

            return $nombre;
          })
          ->editColumn('rfc', function ($registro) {

            if ($registro->rfc == null) {
              $rfc = 'Sin Registro';
            }else{
              $rfc = $registro->rfc;
            }

            return $rfc;
          })
          ->make(true);
          //Cueri
          $data = $datatable->getData();
          foreach ($data->data as $key => $value) {

            $acciones = [

            ];




            $value->acciones = generarDropdown($acciones);
          }
          $datatable->setData($data);
          return $datatable;
          ////////////////////////////////////////////////////////////////




    }

}
