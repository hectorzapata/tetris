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


/////////////////////////////////////////
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use Auth;
use \DB;
class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data['distrito_federal'] = DistritoFederal::where('activo',1)->get();
        $data['distrito_local'] = DistritoLocal::where('activo',1)->get();
        $data['municipio'] = Municipio::where('activo',1)->get();
        $data['codigo_postal'] = CodigoPostal::where('activo',1)->get();
        return view('consultas::index')->with($data);
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
    public function destroy($id)
    {
        //
    }

    public function distrito_local(Request $request){

          $registro_query = "
          SELECT 03_cat_distritoLocal.id, 03_cat_distritoLocal.valor,03_cat_municipio.valor AS municipio FROM 03_cat_distritoFederal
          INNER JOIN 03_cat_distritoLocal ON 03_cat_distritoLocal.cve_03_cat_distritoFederal = 03_cat_distritoFederal.id
          INNER JOIN 03_cat_municipio ON 03_cat_municipio.id = 03_cat_distritoLocal.cve_03_cat_municipio
          WHERE 03_cat_distritoFederal.valor = $request->df";
          $registro = DB::select($registro_query);

          return $registro;

    }

    public function seccion(Request $request){

      $seccion_query = ("
      SELECT 03_cat_seccion.id, 03_cat_seccion.valor FROM  03_cat_distritoLocal
      INNER JOIN 03_cat_seccion ON 03_cat_seccion.cve_03_cat_distritoLocal = 03_cat_distritoLocal.id
      WHERE 03_cat_distritoLocal.id = $request->dl
      ");

      $seccion = DB::select($seccion_query);


       return $seccion;



    }

    public function Concolonia(Request $request){
      //dd($request->cp);

      $colonia =  Colonia::where([
        ['activo',1],
        ['cp',$request->cp]
      ])->get();

      return $colonia;
    }

    public function edad(){
      $fecha_nacimiento = new DateTime("1998-01-25");
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        dd($edad);
    }

    public function TablaIne(Request $request){

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
      t_ciudadano.fecha_naciminto,
      t_ciudadano.curp,

      t_domicilio.calle_domicilio,
      t_domicilio.nombre_asentamiento,
      t_domicilio.cp,
      t_domicilio.localidad,
      03_cat_municipio.valor AS cve_mun,

      01_t_registro_ciudadano.cve_t_registro_ciudadano,
      01_t_registro_ciudadano.nombre_estructura,
      01_t_registro_ciudadano.estatus



      FROM 01_t_registro_ciudadano
      INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_ine ON t_ine.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN 03_cat_municipio ON 03_cat_municipio.id =t_domicilio.cve_mun
      WHERE 01_t_registro_ciudadano.activo = 1 and t_ine.seccion_ine = ".$request->seccion." and t_ine.distrito_fede_ine = ".$request->distrito_fed." and t_ine.distrito_l_ine = ".$request->distrito_loc." ";
      $registro = DB::select($registro_query);



      $datatable = DataTables::of($registro)

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
    }


    public function TablaGenerales(Request $request){

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
      t_ciudadano.fecha_naciminto,
      t_ciudadano.curp,

      t_domicilio.calle_domicilio,
      t_domicilio.nombre_asentamiento,
      t_domicilio.cp,
      t_domicilio.localidad,
      03_cat_municipio.valor AS cve_mun,

      01_t_registro_ciudadano.cve_t_registro_ciudadano,
      01_t_registro_ciudadano.nombre_estructura,
      01_t_registro_ciudadano.estatus



      FROM 01_t_registro_ciudadano
      INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_ine ON t_ine.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN 03_cat_municipio ON 03_cat_municipio.id =t_domicilio.cve_mun
      WHERE 01_t_registro_ciudadano.activo = 1 and 01_t_registro_ciudadano.estatus = ".$request->estatus_ciudadano." and t_ciudadano.genero = '".$request->id_genero."'  ";
      $registro = DB::select($registro_query);



      $datatable = DataTables::of($registro)

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
    }


    public function TablaLocalizacion(Request $request){

      //dd($request->correo_electronico,$request->telefonos,$request->redes_sociales);

        if ($request->correo_electronico == 1) {
          $todos_correo = 'True';
        }else{
          $todos_correo = 'False';
        }

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
      t_ciudadano.fecha_naciminto,
      t_ciudadano.curp,

      t_domicilio.calle_domicilio,
      t_domicilio.nombre_asentamiento,
      t_domicilio.cp,
      t_domicilio.localidad,
      03_cat_municipio.valor AS cve_mun,

      01_t_registro_ciudadano.cve_t_registro_ciudadano,
      01_t_registro_ciudadano.nombre_estructura,
      01_t_registro_ciudadano.estatus



      FROM 01_t_registro_ciudadano
      INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_ine ON t_ine.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN 03_cat_municipio ON 03_cat_municipio.id =t_domicilio.cve_mun
      WHERE 01_t_registro_ciudadano.activo = 1 and 01_t_registro_ciudadano.correo_electronico != ".$todos_correo."  ";
      $registro = DB::select($registro_query);



      $datatable = DataTables::of($registro)

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
    }

    public function TablaDomicilio(Request $request){
      //dd($request->municipio_dom);
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
      t_ciudadano.fecha_naciminto,
      t_ciudadano.curp,

      t_domicilio.calle_domicilio,
      t_domicilio.nombre_asentamiento,
      t_domicilio.cp,
      t_domicilio.localidad,
      03_cat_municipio.valor AS cve_mun,

      01_t_registro_ciudadano.cve_t_registro_ciudadano,
      01_t_registro_ciudadano.nombre_estructura,
      01_t_registro_ciudadano.estatus



      FROM 01_t_registro_ciudadano
      INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN t_ine ON t_ine.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
      INNER JOIN 03_cat_municipio ON 03_cat_municipio.id = t_domicilio.cve_mun
      WHERE 01_t_registro_ciudadano.activo = 1 and t_domicilio.cve_mun = $request->municipio_dom  ";
      $registro = DB::select($registro_query);



      $datatable = DataTables::of($registro)

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
    }


}
