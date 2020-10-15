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
use Modules\Registro\Entities\Municipios;
use Modules\Registro\Entities\Gestiones;
use Modules\Registro\Entities\Estatus_Gestion;
use Modules\Registro\Entities\Beneficiarios;
use Modules\Registro\Entities\Bitacora_Beneficiario;




use Modules\Catalogos\Entities\DistritoFederal;
use Modules\Catalogos\Entities\DistritoLocal;
use Modules\Catalogos\Entities\Municipio;
use Modules\Catalogos\Entities\Entidad;
use Modules\Catalogos\Entities\Colonia;
use Modules\Catalogos\Entities\CodigoPostal;

use Modules\Catalogos\Entities\Gestor;
use Modules\Catalogos\Entities\TipoGestion;




/////////////////////////////////////////
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use Auth;
use \DB;
class GestionesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('registro::gestiones.index');
    }

    public function create(){
        $data['municipio'] = Municipios::where('cve_ent',28)->get();
        $data['gestor'] = Gestor::where('activo',1)->get();
        $data['tipoGestion'] = TipoGestion::where('activo',1)->get();



        return view('registro::gestiones.create')->with($data);
    }

    public function nuevaGestion($id){

        $registro_ciudadano = Registro_Ciudadano::find($id);




        $persona_query = ("
            SELECT * FROM t_ciudadano
            INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
            INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
            INNER JOIN 01_t_cat_telefonos ON 01_t_cat_telefonos.cve_t_registro_ciudadano = 01_t_registro_ciudadano.cve_t_registro_ciudadano
            WHERE t_ciudadano.cve_t_ciudadano = $registro_ciudadano->cve_t_ciudadano
            ");
          $persona =   DB::select($persona_query);

        $data['persona'] = $persona;


        $data['municipio'] = Municipios::where('cve_ent',28)->get();
        $data['gestor'] = Gestor::where('activo',1)->get();
        $data['tipoGestion'] = TipoGestion::where('activo',1)->get();



        return view('registro::gestiones.gestion')->with($data);
    }

    public function edit($id){
      $gestiones = Gestiones::find($id);

      $persona_query = ("
          SELECT * FROM t_ciudadano
          INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 01_t_cat_telefonos ON 01_t_cat_telefonos.cve_t_registro_ciudadano = 01_t_registro_ciudadano.cve_t_registro_ciudadano
          WHERE t_ciudadano.cve_t_ciudadano = $gestiones->cve_t_ciudadano
          ");
        $persona =   DB::select($persona_query);

      $data['persona'] = $persona;

      foreach ($persona as $key => $value) {
        $data['ciudadano_id'] =  $id_ciudadano =$value->cve_t_ciudadano;
      }

      $data['gestiones'] = Gestiones::find($id);
      $data['municipio'] = Municipios::where('cve_ent',28)->get();
      $data['gestor'] = Gestor::where('activo',1)->get();
      $data['tipoGestion'] = TipoGestion::where('activo',1)->get();
      $data['beneficiarios'] = Beneficiarios::where([
        ['activo',1],
        ['cve_t_gestiones',$id]
      ])->get();
      $data['gestione'] = Gestiones::where([
        ['activo',1],
        ['cve_t_ciudadano',$gestiones->cve_t_ciudadano],
        ])->get();


        $data['bitacora'] = Bitacora_Beneficiario::where([
          ['activo',1],
          ['cve_t_gestion',$id],
          ])->get();
      return view('registro::gestiones.create')->with($data);
    }


    public function show($id){
      $gestiones = Gestiones::find($id);

      $persona_query = ("
          SELECT * FROM t_ciudadano
          INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 01_t_cat_telefonos ON 01_t_cat_telefonos.cve_t_registro_ciudadano = 01_t_registro_ciudadano.cve_t_registro_ciudadano
          WHERE t_ciudadano.cve_t_ciudadano = $gestiones->cve_t_ciudadano
          ");
        $persona =   DB::select($persona_query);

      $data['persona'] = $persona;

      $data['gestiones'] = Gestiones::find($id);
      $data['municipio'] = Municipios::where([
        ['cve_ent',28],
        ['cve_mun',$gestiones->municipio],
        ])->get();
        $data['beneficiarios'] = Beneficiarios::where([
          ['activo',1],
          ['cve_t_gestiones',$id]
        ])->get();
      return view('registro::gestiones.show')->with($data);
    }

    public function store(Request $request){
      try {

        if ($request->tipo_peticion == 1) {
          $edit_gestiones = new Gestiones();
          $edit_gestiones->cve_t_ciudadano = $request->id_ciudadano;
          $edit_gestiones->origen_peticion = $request->origen_peticion;
          $edit_gestiones->tipo_peticion = $request->tipo_peticion;
          $edit_gestiones->categoria_peticion = $request->categoria_peticion;
          $edit_gestiones->fecha_recepcion = $request->fecha_recepcion;

          $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          $edit_gestiones->fecha_entrega = $request->fecha_entrega;
          $edit_gestiones->municipio = $request->municipio;
          $edit_gestiones->gestor = $request->gestor;
          $edit_gestiones->procedencia_gestor = $request->procedencia_gestor;

          $edit_gestiones->descripcion_gestor = $request->descripcion_gestor;
          $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
          $edit_gestiones->estatus = 1;

          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();

        }elseif($request->tipo_peticion == 2){

          $edit_gestiones = new Gestiones();
          $edit_gestiones->cve_t_ciudadano = $request->id_ciudadano;
          $edit_gestiones->origen_peticion = $request->origen_peticion;
          $edit_gestiones->tipo_peticion = $request->tipo_peticion;
          $edit_gestiones->categoria_peticion = $request->categoria_peticion;
          $edit_gestiones->fecha_recepcion = $request->fecha_recepcion;

          $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          $edit_gestiones->fecha_entrega = $request->fecha_entrega;
          $edit_gestiones->municipio = $request->municipio;
          $edit_gestiones->gestor = $request->gestor;
          $edit_gestiones->procedencia_gestor = $request->procedencia_gestor;

          $edit_gestiones->descripcion_gestor = $request->descripcion_gestor;
          $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
          $edit_gestiones->representante = 1;

          $edit_gestiones->estatus = 1;

          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();


            foreach ($request->arrayFiguras as $key => $value) {
            /////////////////////// AGREGAR BENEFICIARIO ////////////////////////
            $beneficiario =  new Beneficiarios();
            $beneficiario->cve_t_gestiones = $edit_gestiones->cve_t_gestiones;
            $beneficiario->nombre = $value['nombre'];
            $beneficiario->paterno = $value['paterno'];
            $beneficiario->materno = $value['materno'];
            $beneficiario->curp = $value['curp'];
            $beneficiario->fecha_modal = $value['fecha_modal'];
            $beneficiario->domicilio = $value['domicilio'];
            $beneficiario->telefono = $value['telefono'];
            $beneficiario->cve_t_ciudadano = $value['id_ciudadano'];
            $beneficiario->cve_usuario = Auth::user()->id;
            $beneficiario->save();

            ////////////////// AGREGAR CIUDADANO GRUPAL ///////////////////////
            $edit_gestiones = new Gestiones();
            $edit_gestiones->cve_t_ciudadano = $value['id_ciudadano'];
            $edit_gestiones->origen_peticion = $request->origen_peticion;
            $edit_gestiones->tipo_peticion = $request->tipo_peticion;
            $edit_gestiones->categoria_peticion = $request->categoria_peticion;
            $edit_gestiones->fecha_recepcion = $request->fecha_recepcion;

            $edit_gestiones->fecha_atendido = $request->fecha_atendido;
            $edit_gestiones->fecha_entrega = $request->fecha_entrega;
            $edit_gestiones->municipio = $request->municipio;
            $edit_gestiones->gestor = $request->gestor;
            $edit_gestiones->procedencia_gestor = $request->procedencia_gestor;

            $edit_gestiones->descripcion_gestor = $request->descripcion_gestor;
            $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
            $edit_gestiones->estatus = 1;

            $edit_gestiones->cve_usuario = Auth::user()->id;
            $edit_gestiones->save();

          }


        }



        return response()->json(['success'=>'Se Agrego con Exito']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }

    }

    public function update(Request $request, $id){
      try {

        if ($request->tipo_peticion == 1) {
          //////////////////////////////////////////////////////////////////////////////
          $edit_gestiones = Gestiones::find($id);
          $edit_gestiones->cve_t_ciudadano = $request->id_ciudadano;
          $edit_gestiones->origen_peticion = $request->origen_peticion;
          $edit_gestiones->tipo_peticion = $request->tipo_peticion;
          $edit_gestiones->categoria_peticion = $request->categoria_peticion;
          $edit_gestiones->fecha_recepcion = $request->fecha_recepcion;

          $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          $edit_gestiones->fecha_entrega = $request->fecha_entrega;
          $edit_gestiones->municipio = $request->municipio;
          $edit_gestiones->gestor = $request->gestor;
          $edit_gestiones->procedencia_gestor = $request->procedencia_gestor;

          $edit_gestiones->descripcion_gestor = $request->descripcion_gestor;
          $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;

          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();
        }elseif($request->tipo_peticion == 2){
          //////////////////////////////////////////////////////////////////////////////
          $edit_gestiones = Gestiones::find($id);
          $edit_gestiones->cve_t_ciudadano = $request->id_ciudadano;
          $edit_gestiones->origen_peticion = $request->origen_peticion;
          $edit_gestiones->tipo_peticion = $request->tipo_peticion;
          $edit_gestiones->categoria_peticion = $request->categoria_peticion;
          $edit_gestiones->fecha_recepcion = $request->fecha_recepcion;

          $edit_gestiones->fecha_atendido = $request->fecha_atendido;
          $edit_gestiones->fecha_entrega = $request->fecha_entrega;
          $edit_gestiones->municipio = $request->municipio;
          $edit_gestiones->gestor = $request->gestor;
          $edit_gestiones->procedencia_gestor = $request->procedencia_gestor;

          $edit_gestiones->descripcion_gestor = $request->descripcion_gestor;
          $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;

          $edit_gestiones->cve_usuario = Auth::user()->id;
          $edit_gestiones->save();

          if (isset($request->arrayFiguras)) {
            foreach ($request->arrayFiguras as $key => $value) {

            $beneficiario =  new Beneficiarios();
            $beneficiario->cve_t_gestiones = $id;
            $beneficiario->nombre = $value['nombre'];
            $beneficiario->paterno = $value['paterno'];
            $beneficiario->materno = $value['materno'];
            $beneficiario->curp = $value['curp'];
            $beneficiario->fecha_modal = $value['fecha_modal'];
            $beneficiario->domicilio = $value['domicilio'];
            $beneficiario->telefono = $value['telefono'];
            $beneficiario->cve_t_ciudadano = $value['id_ciudadano'];
            $beneficiario->cve_usuario = Auth::user()->id;
            $beneficiario->save();

            ////////////////// AGREGAR CIUDADANO GRUPAL ///////////////////////
            $edit_gestiones = new Gestiones();
            $edit_gestiones->cve_t_ciudadano = $value['id_ciudadano'];
            $edit_gestiones->origen_peticion = $request->origen_peticion;
            $edit_gestiones->tipo_peticion = $request->tipo_peticion;
            $edit_gestiones->categoria_peticion = $request->categoria_peticion;
            $edit_gestiones->fecha_recepcion = $request->fecha_recepcion;

            $edit_gestiones->fecha_atendido = $request->fecha_atendido;
            $edit_gestiones->fecha_entrega = $request->fecha_entrega;
            $edit_gestiones->municipio = $request->municipio;
            $edit_gestiones->gestor = $request->gestor;
            $edit_gestiones->procedencia_gestor = $request->procedencia_gestor;

            $edit_gestiones->descripcion_gestor = $request->descripcion_gestor;
            $edit_gestiones->apoyo_otorgado = $request->apoyo_otorgado;
            $edit_gestiones->estatus = 1;

            $edit_gestiones->cve_usuario = Auth::user()->id;
            $edit_gestiones->save();

           }
          }




        }


        return response()->json(['success'=>'Se Actualizo con Exito']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }

    }



    public function TraerPersona(Request $request){
    //  dd($request->id);

      $persona_query = ("
          SELECT * FROM t_ciudadano
          INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
          INNER JOIN 01_t_cat_telefonos ON 01_t_cat_telefonos.cve_t_registro_ciudadano = 01_t_registro_ciudadano.cve_t_registro_ciudadano
          WHERE t_ciudadano.cve_t_ciudadano = $request->id
          ");
          //t_ciudadano.nombre LIKE '$request->palabra%'
      $buscarpersona = DB::select($persona_query);


      return $buscarpersona;

    }

    public function TraerPersonas(Request $request){
    //  dd($request->id);

      $gestiones = Gestiones::where([
        ['activo',1],
        ['cve_t_ciudadano',$request->id]
      ])->first();

      if (isset($gestiones)) {
        return 0;
      }else{
        $persona_query = ("
            SELECT * FROM t_ciudadano
            INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
            INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
            INNER JOIN 01_t_cat_telefonos ON 01_t_cat_telefonos.cve_t_registro_ciudadano = 01_t_registro_ciudadano.cve_t_registro_ciudadano
            WHERE t_ciudadano.cve_t_ciudadano = $request->id
            ");
            //t_ciudadano.nombre LIKE '$request->palabra%'
        $buscarpersona = DB::select($persona_query);


        return $buscarpersona;
      }



    }

    public function tabla(Request $request){
      setlocale(LC_TIME, 'es_ES');
      \DB::statement("SET lc_time_names = 'es_ES'");

      $registro = Gestiones::where('activo', 1);
      $datatable = DataTables::of($registro)
      ->editColumn('cve_t_ciudadano', function ($registro) {
        $ciudadano = Ciudadano::find($registro->cve_t_ciudadano);


      $ciudadano_compleyto = $ciudadano->nombre.' '.$ciudadano->paterno.' '.$ciudadano->materno;
         return $ciudadano_compleyto;
      })
       ->editColumn('municipio', function ($registro) {


        $municipios = Municipios::where([['cve_ent',28],['cve_mun',$registro->municipio]])->get();

        foreach ($municipios as $key => $value) {
          $name_municipio = $value->nom_mun;
        }

        return $name_municipio;
       })
       ->editColumn('tipo_peticion', function ($registro) {

        if ($registro->tipo_peticion == 1) {
          $peticion = 'Individual';
        }else{
          $peticion = 'Grupal';
        }

        return $peticion;
       })
       ->editColumn('categoria_peticion', function ($registro) {

        return $registro->obtCategoria->valor;

       })

       ->editColumn('origen_peticion', function ($registro) {

        if($registro->origen_peticion == 1){
          $origen = 'Jornada';
        }else{
          $origen = 'Inaguración';
        }
        return $origen;
       })
       ->editColumn('gestor', function ($registro) {

       return $registro->obtGestor->valor;
       })
       ->editColumn('fecha_atendido', function ($registro) {

        if($registro->fecha_atendido == null){
          $fecha = 'Sin fecha de atención';
        }else{
          $fecha = $registro->fecha_atendido;
        }
        return $fecha;
       })
       ->editColumn('representante', function($registro) {

         if ($registro->representante == 1) {
            $representante = 'Si';
         }else{
           $representante = 'No';
         }
         return $representante;
       })
       ->editColumn('estatus', function($registro) {

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

          if ($value->estatus == 'Entregada') {
            $acciones = [

              "Ver detalles" => [
                "icon" => "eye teal",
                "href" => "/gestiones/$value->cve_t_gestiones/show"
              ],


              "Actualizar Estatus" => [
                "icon" => "eye teal",
                "onclick" => "estatus('$value->cve_t_gestiones')"

              ]
            ];
          }elseif($value->estatus == 'Cancelada'){
            $acciones = [

              "Ver detalles" => [
                "icon" => "eye teal",
                "href" => "/gestiones/$value->cve_t_gestiones/show"
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
    //////////////////// BENEFICIARIOS ///////////////////////////////////
    public function GuardarBeneficiario(Request $request){

      try {
        $beneficiario = new Beneficiarios();
        $beneficiario->cve_t_ciudadano = $request->id_ciudadano_modal;
        $beneficiario->cve_usuario = Auth::user()->id;
        $beneficiario->save();

        return response()->json(['success'=>'Se Agrego con Exito']);

      } catch (\Exception $e) {
        dd($e->getMessage());
      }

    }

    ////////////// TABLA BENEFICIARIOS //////////////////////////////////////
    // public function tablaBeneficiarios(Request $request){
    //   setlocale(LC_TIME, 'es_ES');
    //   \DB::statement("SET lc_time_names = 'es_ES'");
    //
    //   $beneficiarios = Beneficiarios::where([
    //     ['activo', 1],
    //     ['cve_t_gestiones',1]
    //   ]);
    //
    //   $datatable = DataTables::of($beneficiarios)
    //   ->editColumn('representante', function ($beneficiarios) {
    //     if ($beneficiarios->representante == null) {
    //       $representante = 'No';
    //     }
    //      return $representante;
    //   })
    //   ->editColumn('nombre', function ($beneficiarios) {
    //
    //     $ciudadano = Ciudadano::find($beneficiarios->cve_t_ciudadano);
    //
    //     $nombre_completo = $ciudadano->nombre.' '.$ciudadano->paterno.' '.$ciudadano->materno;
    //      return $nombre_completo;
    //   })
    //   ->editColumn('domicilio', function ($beneficiarios) {
    //
    //     $domicilio = Domicilio::where([
    //       ['activo',1],
    //       ['cve_t_ciudadano',$beneficiarios->cve_t_ciudadano]
    //     ])->get();
    //
    //     foreach ($domicilio as $key => $value) {
    //       $ciudado_domicilio = 'Calle:'.$value->calle_domicilio.', #'.$value->num_ext.', C.P:'.$value->cp;
    //     }
    //
    //      return $ciudado_domicilio;
    //   })
    //
    //   ->editColumn('municipio', function ($beneficiarios) {
    //
    //     $municipio = Domicilio::where([
    //       ['activo',1],
    //       ['cve_t_ciudadano',$beneficiarios->cve_t_ciudadano]
    //     ])->get();
    //
    //     foreach ($municipio as $key => $value_mun) {
    //       $ciudado_municipio = $value_mun->cve_mun;
    //     }
    //
    //     $municipios = Municipios::where([['cve_ent',28],['cve_mun',$ciudado_municipio]])->get();
    //
    //     foreach ($municipios as $key => $value) {
    //       $name_municipio = $value->nom_mun;
    //     }
    //
    //     return $name_municipio;
    //   })
    //
    //   ->editColumn('telefono', function ($beneficiarios) {
    //
    //     $registros = Registro_Ciudadano::where([
    //       ['activo',1],
    //       ['cve_t_ciudadano',$beneficiarios->cve_t_ciudadano]
    //     ])->get();
    //
    //     foreach ($registros as $key => $value) {
    //       $id_registro = $value->cve_t_registro_ciudadano;
    //     }
    //
    //
    //     $telefonos = Telefonos::where([
    //       ['activo',1],
    //       ['cve_t_registro_ciudadano',$id_registro]
    //     ])->get();
    //
    //     foreach ($telefonos as $key => $value_t) {
    //       $telfs = $value_t->numero_telefono;
    //     }
    //
    //
    //     return $telfs;
    //   })
    //
    //
    //   ->make(true);
    //   //Cueri
    //   $data = $datatable->getData();
    //   foreach ($data->data as $key => $value) {
    //
    //       $acciones = [
    //         "Eliminar" => [
    //           "icon" => "trash red",
    //           "onclick" => "EliminarBeneficiario('$value->cve_t_beneficiario')"
    //         ]
    //       ];
    //
    //     $value->acciones = generarDropdown($acciones);
    //   }
    //   $datatable->setData($data);
    //   return $datatable;
    // }

    public function bitacora(Request $request){

      try {
        $bitacora_beneficiario = new Bitacora_Beneficiario();
        $bitacora_beneficiario->cve_t_gestion = $request->id;
        $bitacora_beneficiario->fecha = date('Y-m-d');
        $bitacora_beneficiario->hora = date('H:i:s');
        $bitacora_beneficiario->movimiento = $request->comentario_bitacora;
        $bitacora_beneficiario->cve_usuario = Auth::user()->id;
        $bitacora_beneficiario->save();

        return response()->json(['success'=>'Agregado exitosamente']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }




    }




    public function destroy(Request $request)
      {

         $gestiones_eliminar = Gestiones::find($request->id_registro);
         $gestiones_eliminar->activo = 0;
         $gestiones_eliminar->save();

         return response()->json(['success'=>'Eliminado exitosamente']);
      }

    //////////////// ELIMINAR BENEFICIARIO /////////////////////////////////
    public function EliminarBeneficiario(Request $request){

         $beneficiario_eliminar = Beneficiarios::find($request->id);
         $beneficiario_eliminar->activo = 0;
         $beneficiario_eliminar->save();

        // return response()->json(['success'=>'Eliminado exitosamente']);
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

    public function search(Request $request){

        if($request->ajax()) {

            $data = Ciudadano::where('nombre', 'LIKE', $request->ciudadano.'%')
                ->get();

            $output = '';

            if (count($data)>0) {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                foreach ($data as $row){

                    $output .= '<li class="list-group-item" onclick="set_item2('.$row->cve_t_ciudadano.')">'.$row->nombre.' '.$row->paterno.' '.$row->materno.'</li>';
                }

                $output .= '</ul>';
            }
            else {

                $output .= '<li class="list-group-item">'.'No Existen Resultados'.'</li>';
            }

            return $output;
        }
    }


    public function search2(Request $request){

        if($request->ajax()) {

            $data = Ciudadano::where('nombre', 'LIKE', $request->ciudadano.'%')
                ->get();

            $output = '';

            if (count($data)>0) {

                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

                foreach ($data as $row){

                    $output .= '<li class="list-group-item" onclick="set_item('.$row->cve_t_ciudadano.')">'.$row->nombre.' '.$row->paterno.' '.$row->materno.'</li>';
                }

                $output .= '</ul>';
            }
            else {

                $output .= '<li class="list-group-item">'.'No Existen Resultados'.'</li>';
            }

            return $output;
        }
    }






}
