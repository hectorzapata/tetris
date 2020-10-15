<?php

namespace Modules\Registro\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
////////////////////////////////////////////////
use Modules\Registro\Entities\Registro_Ciudadano;
use Modules\Registro\Entities\Ciudadano;
use Modules\Registro\Entities\Domicilio;
use Modules\Registro\Entities\Red_Social;
use Modules\Registro\Entities\Telefonos;
use Modules\Registro\Entities\Ine;
use Modules\Registro\Entities\Suspender;
use Modules\Registro\Entities\Bitacora;
use Modules\Catalogos\Entities\DistritoFederal;
use Modules\Catalogos\Entities\DistritoLocal;
use Modules\Catalogos\Entities\Municipio;
use Modules\Catalogos\Entities\Entidad;
use Modules\Catalogos\Entities\Colonia;
use Modules\Catalogos\Entities\CodigoPostal;



/////////////////////////////////////////
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use Auth;
use \DB;
class RegistroSuspendidoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('registro::registro_suspenido.index');
    }

    public function tablaSuspendida(Request $request){
    	 setlocale(LC_TIME, 'es_ES');
      \DB::statement("SET lc_time_names = 'es_ES'");
      //$registro = Registro_Ciudadano::where('activo', '!=', 0);

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
                  t_domicilio.cve_mun,
                  t_domicilio.num_ext,

                  01_t_registro_ciudadano.cve_t_registro_ciudadano,
                  01_t_registro_ciudadano.nombre_estructura,
                  01_t_registro_ciudadano.estatus,
                  01_t_registro_ciudadano.created_at as fecha_registro



                  FROM 01_t_registro_ciudadano
                  INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
                  INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
                  INNER JOIN t_ine ON t_ine.cve_t_ciudadano = 01_t_registro_ciudadano.cve_t_ciudadano
                  WHERE 01_t_registro_ciudadano.activo = 1 and 01_t_registro_ciudadano.estatus = 2";

      $registro = DB::select($registro_query);



      $datatable = DataTables::of($registro)
       ->editColumn('estatus', function ($registro) {

        if ($registro->estatus == 1) {
          $estatus = 'Registrado';
        }elseif($registro->estatus == 2){
          $estatus = 'Suspendida';
        }
      
         return $estatus;
      })
       ->editColumn('nombre', function ($registro) {
        return $registro->nombre.' '.$registro->paterno.' '.$registro->materno;
       })
       ->editColumn('calle_domicilio', function($registro) {
         return $registro->calle_domicilio.', #'.$registro->num_ext.','.$registro->cp;
       })
      // ->editColumn('nombres', function ($user) {
      //   return $user->nombres;
      // })
      // ->filterColumn('nombres', function($query, $keyword) {
      //   $query->whereRaw("CONCAT(users.nombres, users.apellidos) like ?", ["%{$keyword}%"]);
      // })
      // ->filterColumn('created_at', function ($query, $keyword) {
      //   $query->whereRaw("DATE_FORMAT(created_at,'%d %M %Y') like ?", ["%$keyword%"]);
      // })
      // ->editColumn('objectguid', function($user) {
      //   return [
      //     'display' => ( is_null($user->objectguid) ) ? "Invitado" : "Directorio Activo",
      //     'sorteable' => $user->objectguid
      //   ];
      // })
      ->make(true);
      //Cueri
      $data = $datatable->getData();
      foreach ($data->data as $key => $value) {

          $acciones = [
            "Ver detalles" => [
              "icon" => "eye teal",
              "href" => "/registro/$value->cve_t_registro_ciudadano/show"
            ],
            "Activar" => [
              "icon" => "trash red",
              "onclick" => "activar('$value->cve_t_registro_ciudadano')"
            ]
          ];
        

        // if ( !permiso('01', 'Editar Registro') ) {
        //   unset($acciones['Editar']);
        // }
        // if ( !permiso('01', 'Ver Registro') ) {
        //   unset($acciones['Ver detalles']);
        // }
        // if ( !permiso('01', 'Eliminar Registro') ) {
        //   unset($acciones['Eliminar']);
        // }
        $value->acciones = generarDropdown($acciones);
      }
      $datatable->setData($data);
      return $datatable;
    }

    public function activar(Request $request){
      $ciudadano_query  =  ("
      SELECT
      t_ciudadano.curp,
      t_ciudadano.rfc,
      t_ciudadano.created_at,

      users.nombres,
      users.apellidos,

      01_t_registro_ciudadano.nombre_estructura,
      01_t_registro_ciudadano.created_at,

      01_t_suspender_registro.motivo
      FROM t_ciudadano
      INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
      INNER JOIN users ON users.id = 01_t_registro_ciudadano.cve_usuario
      INNER JOIN 01_t_suspender_registro ON 01_t_suspender_registro.cve_t_registro_ciudadano = 01_t_registro_ciudadano.cve_t_registro_ciudadano
      WHERE t_ciudadano.activo = 1 and 01_t_registro_ciudadano.cve_t_registro_ciudadano = '".$request->id."'
      ");

      $ciudadano_curp = DB::select($ciudadano_query);

      $datos = [];

      $datos_curp = [];
      $datos_rfc = [];
      $datos_fecha = [];
      $datos_responsable = [];
      $datos_estructura = [];
      $datos_motivo = [];

      foreach ($ciudadano_curp as $key => $value) {
        $curp = $value->curp;
        $rfc = $value->rfc;
        list($fechas,$hora) = explode(" ",$value->created_at);
        $fecha = $fechas;
        $responsable = $value->nombres.' '.$value->apellidos;
        $nombre_estructura = $value->nombre_estructura;
        $motivo = $value->motivo;

        ////////////////////////////////////////////////////
        array_push($datos_curp,$curp);
        array_push($datos_rfc,$rfc);
        array_push($datos_fecha,$fecha);
        array_push($datos_responsable,$responsable);
        array_push($datos_estructura,$nombre_estructura);
        array_push($datos_motivo,$motivo);

      }



      $datos = ['curp' => $datos_curp,'rfc' => $datos_rfc,'fecha'=> $datos_fecha,'responsable'=> $datos_responsable,'estructura'=> $datos_estructura,'motivo'=> $datos_motivo];

      return  $datos;
    }

    public function activar_registro(Request $request){

      $registro = Registro_Ciudadano::find($request->id);
      $registro->estatus = 1;
      $registro->cve_usuario = Auth::user()->id;
      $registro->save();

      return response()->json(['success'=>'Registro Activo exitosamente']);
    }

}
