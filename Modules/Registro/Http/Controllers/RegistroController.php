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
use Modules\Registro\Entities\Clave_Elector;
use Modules\Registro\Entities\Distritos;
use Modules\Registro\Entities\Entidades;
use Modules\Registro\Entities\Municipios;
use Modules\Registro\Entities\Gestiones;


use Modules\Catalogos\Entities\DistritoFederal;
use Modules\Catalogos\Entities\DistritoLocal;
use Modules\Catalogos\Entities\Seccion;

use Modules\Catalogos\Entities\Municipio;
use Modules\Catalogos\Entities\Entidad;
use Modules\Catalogos\Entities\Colonia;
use Modules\Catalogos\Entities\CodigoPostal;

use Modules\Estructuras\Entities\Estructuras;



use Modules\Estructuras\Entities\EstructurasNiveles;
use Modules\Estructuras\Entities\EstructurasResponsables;
use Modules\Catalogos\Entities\Zona;
use Modules\Estructuras\Http\Controllers\GeneralesController;
/////////////////////////////////////////
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use Auth;
use \DB;
class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('registro::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $reg = Estructuras::where([ ['activo', 1], ['cve_usuario', 5] ])->get();
        //dd($reg);
        $data['id_estructura'] = 0;


        $data['distrito_f'] = DistritoFederal::where('activo',1)->get();
        $data['distrito_l'] = DistritoLocal::where('activo',1)->get();
        $data['municipio'] = Municipio::where('activo',1)->get();
        $data['entidad'] = Entidades::where([['activo',1],['cve_estado',28]])->get();
        $data['entidad2'] = Entidades::where([['activo',1]])->get();
        return view('registro::create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        try {

            $ciudadano = Ciudadano::where([
              ['activo',1],
              ['curp',$request->curp]
            ])->first();

            if (isset($ciudadano)) {
              return response()->json(['warning'=>'Ya existe este Registro']);
            }else{
              //////////////////////////////////////////////////////////////////////////////
              $registro_ciudadano = new Registro_Ciudadano();
              $registro_ciudadano->nombre_estructura = $request->nombre_estructura;
              $registro_ciudadano->cve_nivel = $request->cve_nivel;
              $registro_ciudadano->cve_responsable = $request->cve_responsable;
              $registro_ciudadano->cve_poligono = $request->cve_poligono;
              $registro_ciudadano->cve_cedula = $request->cve_cedula;
              $registro_ciudadano->correo_electronico = $request->correo_electronico;
              $registro_ciudadano->estatus = 1;
              $registro_ciudadano->cve_usuario = Auth::user()->id;
              $registro_ciudadano->save();
              /////////////////////////////////////////////////////////////////////////////
              $ciudadano = new Ciudadano();
              $ciudadano->nombre = $request->nombre;
              $ciudadano->paterno = $request->paterno;
              $ciudadano->materno = $request->materno;
              $ciudadano->rfc = $request->rfc;
              $ciudadano->curp = $request->curp;
              $ciudadano->genero = $request->genero;
              $ciudadano->fecha_naciminto = $request->fecha_naciminto;
              //$ciudadano->estado_nacimiento = $request->estado_nacimiento;
              $ciudadano->cve_usuario = Auth::user()->id;
              $ciudadano->save();
              ////////////////////////////////////////////////////////////////////////////
              $ciudadano_registro = Registro_Ciudadano::where([
                ['activo',1],
                ['cve_t_registro_ciudadano',$registro_ciudadano->cve_t_registro_ciudadano]
              ])->update([
                "cve_t_ciudadano" => $ciudadano->cve_t_ciudadano,
              ]);

              /////////////////////////////////////////////////////////////////////////////
              $domicilio = new Domicilio();
              $domicilio->cve_t_ciudadano = $ciudadano->cve_t_ciudadano;
              $domicilio->calle_domicilio = $request->calle;
              $domicilio->num_ext = $request->num_ext;
              $domicilio->num_int = $request->num_int;
              $domicilio->calle_ref1 = $request->calle_ref1;
              $domicilio->cp = $request->cp;
              $domicilio->nombre_asentamiento = $request->nombre_asentamiento;
              $domicilio->cve_ent = $request->cve_ent;
              $domicilio->cve_mun = $request->cve_mun;
              $domicilio->localidad = $request->localidad;
              $domicilio->cve_usuario = Auth::user()->id;
              $domicilio->save();
              /////////////////////////////////////////////////////////////////////////////

              foreach($request->telefonos as $key => $value) {

                $telefonos = new Telefonos();
                $telefonos->cve_t_registro_ciudadano = $ciudadano->cve_t_ciudadano;
                $telefonos->cve_tipo_telefono = $value['id_telefono'];
                $telefonos->numero_telefono = $value['telefono'];
                $telefonos->cve_usuario = Auth::user()->id;
                $telefonos->save();
              }

              //////////////////////////////////////////////////////////////////////////////
              foreach($request->redes as $key => $value_red) {

                $redes = new Red_Social();
                $redes->cve_t_registro_ciudadano = $ciudadano->cve_t_ciudadano;
                $redes->cve_cat_red_social = $value_red['id_red'];
                $redes->nombre_usuario = $value_red['red'];
                $redes->cve_usuario = Auth::user()->id;
                $redes->save();
              }
              ////////////////////////////////////////////////////////////////////
              $ine = new Ine();
              $ine->cve_t_ciudadano = $ciudadano->cve_t_ciudadano;
              $ine->clave_elector = $request->clave_elector;
              $ine->seccion_ine = $request->seccion_ine;
              $ine->vigencia_ine = $request->vigencia_ine;
              $ine->calle_ine = $request->calle_ine;
              $ine->num_ext_ine = $request->num_ext_ine;
              $ine->num_int_ine = $request->num_int_ine;
              $ine->colonia_ine = $request->colonia_ine;
              $ine->cp_ine = $request->cp_ine;
              $ine->estado_ine = $request->estado_ine;
              $ine->municipio_ine = $request->municipio_ine;
              $ine->distrito_fede_ine  = $request->distrito_fede_ine;
              $ine->distrito_l_ine = $request->distrito_l_ine;
              $ine->cve_usuario = Auth::user()->id;
              $ine->save();
              /////////////////// BITACORA /////////////////////////////
              list($fecha,$hora) = explode(" ",$request->fecha_bitacora);

              $bitacora = new Bitacora();
              $bitacora->cve_t_registro_ciudadano = $registro_ciudadano->cve_t_registro_ciudadano;
              $bitacora->fecha = $fecha;
              $bitacora->hora = $hora;
              $bitacora->movimiento = '';
              $bitacora->cve_usuario = Auth::user()->id;
              $bitacora->save();

              //////////////////////////////////////////////////////////////////////////
              return response()->json(['success'=>'Se Agrego Registro con Exito']);
            }

            } catch (\Exception $e) {
              dd($e->getMessage());
              //return response()->json(['success'=>'Successfully Added']);
            }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
      $registro = Registro_Ciudadano::
            join('t_ciudadano', 't_ciudadano.cve_t_ciudadano', '=', '01_t_registro_ciudadano.cve_t_ciudadano')->
            join('t_domicilio', 't_domicilio.cve_t_ciudadano', '=', '01_t_registro_ciudadano.cve_t_ciudadano')->
            join('t_ine', 't_ine.cve_t_ciudadano', '=', '01_t_registro_ciudadano.cve_t_ciudadano')->

            join('03_cat_entidad as ent', 'ent.id' ,'=' ,'t_domicilio.cve_ent')->
            join('03_cat_entidad as ent_ine', 'ent_ine.id' ,'=' ,'t_ine.estado_ine')->
            join('03_cat_municipio as mun', 'mun.id' ,'=', 't_domicilio.cve_mun')->
            join('03_cat_municipio as mun_ine', 'mun_ine.id', '=', 't_ine.municipio_ine')->

            select(       '01_t_registro_ciudadano.nombre_estructura',

                          '01_t_registro_ciudadano.cve_nivel',
                          '01_t_registro_ciudadano.cve_responsable',
                          '01_t_registro_ciudadano.cve_poligono',
                          '01_t_registro_ciudadano.cve_cedula',
                          '01_t_registro_ciudadano.correo_electronico',
                          '01_t_registro_ciudadano.cve_t_ciudadano',
                          "01_t_registro_ciudadano.cve_t_registro_ciudadano",
                          't_ciudadano.nombre',
                          't_ciudadano.paterno',
                          't_ciudadano.materno',
                          't_ciudadano.rfc',
                          't_ciudadano.curp',
                          't_ciudadano.genero',
                          't_ciudadano.fecha_naciminto',

                          't_domicilio.cve_t_ciudadano',
                          't_domicilio.calle_domicilio',
                          't_domicilio.num_ext',
                          't_domicilio.num_int',
                          't_domicilio.calle_ref1',
                          't_domicilio.cp',
                          't_domicilio.nombre_asentamiento',
                          't_domicilio.cve_ent',
                          't_domicilio.cve_mun',
                          't_domicilio.localidad',

                          DB::raw("ent.valor as domicilio_entidad"),
                          DB::raw("mun.valor as domicilio_municipio"),
                          DB::raw("ent_ine.valor as ine_entidad"),
                          DB::raw("mun_ine.valor as ine_municipio"),

                          't_ine.cve_t_ciudadano',
                          't_ine.clave_elector',
                          't_ine.seccion_ine',
                          't_ine.vigencia_ine',
                          't_ine.calle_ine',
                          't_ine.num_ext_ine',
                          't_ine.num_int_ine',
                          't_ine.colonia_ine',
                          't_ine.cp_ine',
                          't_ine.estado_ine',
                          't_ine.distrito_fede_ine',
                          't_ine.distrito_l_ine',

                          't_ine.municipio_ine')
            ->where([
              ['01_t_registro_ciudadano.activo', '=', '1'],
              ['01_t_registro_ciudadano.cve_t_registro_ciudadano', '=', $id],
            ])->get();



            foreach ($registro as $key => $value) {
              $id_ciudadano = $value->cve_t_ciudadano;
              $data['registro'] = $value;
            }
            $data['red_social'] = Red_Social::where([
              ['activo',1],
              ['cve_t_registro_ciudadano',$id_ciudadano]
            ])->get();

            $data['telefonos'] = Telefonos::where([
              ['activo',1],
              ['cve_t_registro_ciudadano',$id_ciudadano]
            ])->get();

            $data['distrito_f'] = DistritoFederal::where('activo',1)->get();
            $data['distrito_l'] = DistritoLocal::where('activo',1)->get();
            $data['municipio'] = Municipio::where('activo',1)->get();
            $data['entidad'] = Entidad::where('activo',1)->get();
            $data['bitacora'] = Bitacora::where([
              ['activo',1],
              ['cve_t_registro_ciudadano',$id],
              ])->get();

              $data['gestiones'] = Gestiones::where([
                ['activo',1],
                ['cve_t_ciudadano',$id_ciudadano],
                ])->get();

        return view('registro::show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

      $registro = Registro_Ciudadano::
            join('t_ciudadano', 't_ciudadano.cve_t_ciudadano', '=', '01_t_registro_ciudadano.cve_t_ciudadano')->
            join('t_domicilio', 't_domicilio.cve_t_ciudadano', '=', '01_t_registro_ciudadano.cve_t_ciudadano')->
            join('t_ine', 't_ine.cve_t_ciudadano', '=', '01_t_registro_ciudadano.cve_t_ciudadano')->

            join('03_cat_entidad as ent', 'ent.id' ,'=' ,'t_domicilio.cve_ent')->
            join('03_cat_entidad as ent_ine', 'ent_ine.id' ,'=' ,'t_ine.estado_ine')->
            join('03_cat_municipio as mun', 'mun.id' ,'=', 't_domicilio.cve_mun')->
            join('03_cat_municipio as mun_ine', 'mun_ine.id', '=', 't_ine.municipio_ine')->

            select(       '01_t_registro_ciudadano.nombre_estructura',

                          '01_t_registro_ciudadano.cve_nivel',
                          '01_t_registro_ciudadano.cve_responsable',
                          '01_t_registro_ciudadano.cve_poligono',
                          '01_t_registro_ciudadano.cve_cedula',
                          '01_t_registro_ciudadano.correo_electronico',
                          '01_t_registro_ciudadano.cve_t_ciudadano',
                          "01_t_registro_ciudadano.cve_t_registro_ciudadano",
                          't_ciudadano.nombre',
                          't_ciudadano.paterno',
                          't_ciudadano.materno',
                          't_ciudadano.rfc',
                          't_ciudadano.curp',
                          't_ciudadano.genero',
                          't_ciudadano.fecha_naciminto',

                          't_domicilio.cve_t_ciudadano',
                          't_domicilio.calle_domicilio',
                          't_domicilio.num_ext',
                          't_domicilio.num_int',
                          't_domicilio.calle_ref1',
                          't_domicilio.cp',
                          't_domicilio.nombre_asentamiento',
                          't_domicilio.cve_ent',
                          't_domicilio.cve_mun',
                          't_domicilio.localidad',

                          DB::raw("ent.valor as domicilio_entidad"),
                          DB::raw("mun.valor as domicilio_municipio"),
                          DB::raw("ent_ine.valor as ine_entidad"),
                          DB::raw("mun_ine.valor as ine_municipio"),

                          't_ine.cve_t_ciudadano',
                          't_ine.clave_elector',
                          't_ine.seccion_ine',
                          't_ine.vigencia_ine',
                          't_ine.calle_ine',
                          't_ine.num_ext_ine',
                          't_ine.num_int_ine',
                          't_ine.colonia_ine',
                          't_ine.cp_ine',
                          't_ine.estado_ine',
                          't_ine.distrito_fede_ine',
                          't_ine.distrito_l_ine',
                          't_ine.municipio_ine')
            ->where([
              ['01_t_registro_ciudadano.activo', '=', '1'],
              ['01_t_registro_ciudadano.cve_t_registro_ciudadano', '=', $id],
            ])->get();



            foreach ($registro as $key => $value) {
              $id_ciudadano = $value->cve_t_ciudadano;
              $data['registro'] = $value;
            }
            $data['red_social'] = Red_Social::where([
              ['activo',1],
              ['cve_t_registro_ciudadano',$id_ciudadano]
            ])->get();

            $data['telefonos'] = Telefonos::where([
              ['activo',1],
              ['cve_t_registro_ciudadano',$id_ciudadano]
            ])->get();

            $data['distrito_f'] = DistritoFederal::where('activo',1)->get();
            $data['distrito_l'] = DistritoLocal::where('activo',1)->get();
            $data['municipio'] = Municipio::where('activo',1)->get();
            $data['entidad'] = Entidades::where([['activo',1],['cve_estado',28]])->get();
            $data['entidad2'] = Entidades::where([['activo',1]])->get();
            $data['bitacora'] = Bitacora::where([
              ['activo',1],
              ['cve_t_registro_ciudadano',$id],
              ])->get();
              $data['gestiones'] = Gestiones::where([
                ['activo',1],
                ['cve_t_ciudadano',$id_ciudadano],
                ])->get();
            return view('registro::create')->with($data);
        //return view('registro::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

      try {
          //////////////////////////////////////////////////////////////////////////////
          $registro_ciudadano = Registro_Ciudadano::find($id);
          $registro_ciudadano->nombre_estructura = $request->nombre_estructura;
          $registro_ciudadano->cve_nivel = $request->cve_nivel;
          $registro_ciudadano->cve_responsable = $request->cve_responsable;
          $registro_ciudadano->cve_poligono = $request->cve_poligono;
          $registro_ciudadano->cve_cedula = $request->cve_cedula;
          $registro_ciudadano->correo_electronico = $request->correo_electronico;
          //$registro_ciudadano->estatus = 1;
          $registro_ciudadano->cve_usuario = Auth::user()->id;
          $registro_ciudadano->save();
          /////////////////////////////////////////////////////////////////////////////
          $ciudadano = Ciudadano::find($registro_ciudadano->cve_t_ciudadano);
          $ciudadano->nombre = $request->nombre;
          $ciudadano->paterno = $request->paterno;
          $ciudadano->materno = $request->materno;
          $ciudadano->rfc = $request->rfc;
          $ciudadano->curp = $request->curp;
          $ciudadano->genero = $request->genero;
          $ciudadano->fecha_naciminto = $request->fecha_naciminto;
          //$ciudadano->estado_nacimiento = $request->estado_nacimiento;
          $ciudadano->cve_usuario = Auth::user()->id;
          $ciudadano->save();


          /////////////////////////////////////////////////////////////////////////////
          $domicilio = Domicilio::where([
            ['activo',1],
            ['cve_t_ciudadano',$ciudadano->cve_t_ciudadano],
            ])->update([
              "calle_domicilio" => $request->calle,
              "num_ext" => $request->num_ext,
              "num_int" => $request->num_int,
              "calle_ref1" => $request->calle_ref1,
              "cp" => $request->cp,
              "nombre_asentamiento" => $request->nombre_asentamiento,
              "cve_ent" => $request->cve_ent,
              "cve_mun" => $request->cve_mun,
              "localidad" => $request->localidad,
              "cve_usuario" => Auth::user()->id,

            ]);

          /////////////////////////////////////////////////////////////////////////////
          if ($request->telefonos == '') {
            // code...
          }else{
            foreach($request->telefonos as $key => $value) {

              $telefonos = new Telefonos();
              $telefonos->cve_t_registro_ciudadano = $ciudadano->cve_t_ciudadano;
              $telefonos->cve_tipo_telefono = $value['id_telefono'];
              $telefonos->numero_telefono = $value['telefono'];
              $telefonos->cve_usuario = Auth::user()->id;
              $telefonos->save();
            }

          }

          //////////////////////////////////////////////////////////////////////////////
          if ($request->redes == '') {

          }else{
            foreach($request->redes as $key => $value_red) {

              $redes = new Red_Social();
              $redes->cve_t_registro_ciudadano = $ciudadano->cve_t_ciudadano;
              $redes->cve_cat_red_social = $value_red['id_red'];
              $redes->nombre_usuario = $value_red['red'];
              $redes->cve_usuario = Auth::user()->id;
              $redes->save();
            }
          }
          // dd($request->cp_ine);
          ////////////////////////////////////////////////////////////////////
          $ine = Ine::where([
            ['activo',1],
            ['cve_t_ciudadano',$ciudadano->cve_t_ciudadano]
          ])->update([
            "clave_elector" => $request->clave_elector,
            "seccion_ine" => $request->seccion_ine,
            "vigencia_ine" => $request->vigencia_ine,
            "calle_ine" => $request->calle_ine,
            "num_ext_ine" => $request->num_ext_ine,
            "num_int_ine" => $request->num_int_ine,
            "colonia_ine" => $request->colonia_ine,
            "cp_ine" => $request->cp_ine,
            "estado_ine" => $request->estado_ine,
            "municipio_ine" => $request->municipio_ine,
            "distrito_fede_ine"  => $request->distrito_fede_ine,
            "distrito_l_ine" => $request->distrito_l_ine,
            "cve_usuario" => Auth::user()->id,
          ]);

          /////////////////// BITACORA /////////////////////////////
          list($fecha,$hora) = explode(" ",$request->fecha_bitacora);

          $bitacora = new Bitacora();
          $bitacora->cve_t_registro_ciudadano = $registro_ciudadano->cve_t_registro_ciudadano;
          $bitacora->fecha = $fecha;
          $bitacora->hora = $hora;
          $bitacora->cve_usuario = Auth::user()->id;
          $bitacora->save();

          //////////////////////////////////////////////////////////////////////////
          return response()->json(['success'=>'Se Actualizo con Exito']);
          } catch (\Exception $e) {
            dd($e->getMessage());
            //return response()->json(['success'=>'Successfully Added']);
          }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {

       $registro_ciudadano = Registro_Ciudadano::find($request->id_user);
       $registro_ciudadano->activo = 0;
       $registro_ciudadano->save();

       return response()->json(['success'=>'Eliminado exitosamente']);
    }

    public function tabla(Request $request){
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
                  t_ciudadano.cve_t_ciudadano,

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
                  WHERE 01_t_registro_ciudadano.activo = 1 and 01_t_registro_ciudadano.estatus = 1";

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

       ->editColumn('cve_mun', function ($registro) {

        $municipios = Municipios::where([['cve_ent',28],['cve_mun',$registro->cve_mun]])->get();

        foreach ($municipios as $key => $value) {
          $name_municipio = $value->nom_mun;
        }

        return $name_municipio;
       })

       ->editColumn('calle_domicilio', function($registro) {
         return $registro->calle_domicilio.', #'.$registro->num_ext.','.$registro->cp;
       })

       ->editColumn('apoyo', function ($registro) {

        $gestiones = Gestiones::where([
          ['activo',1],
          ['cve_t_ciudadano',$registro->cve_t_ciudadano]
        ])->count('cve_t_ciudadano');

        return $gestiones;
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

        $gestiones = Gestiones::where([
          ['activo',1],
          ['cve_t_ciudadano',$value->cve_t_ciudadano]
        ])->first();

        if (isset($gestiones)) {

          $acciones = [
            "Editar" => [
              "icon" => "edit blue",
              "href" => "/registro/$value->cve_t_registro_ciudadano/edit"
            ],

            "Ver detalles" => [
              "icon" => "eye teal",
              "href" => "/registro/$value->cve_t_registro_ciudadano/show"
            ],
            "Suspender" => [
              "icon" => "trash red",
              "onclick" => "eliminar('$value->cve_t_registro_ciudadano')"
            ],
            "Registrar Gestión" => [
              "icon" => "trash red",
              "href" => "/registro/$value->cve_t_registro_ciudadano/Nuevagestion"
            ],
            "Ver Gestiones" => [
              "icon" => "eye teal",
              "onclick" => "verGestion('$value->cve_t_registro_ciudadano')"
            ]
          ];


        }else{

          $acciones = [
            "Editar" => [
              "icon" => "edit blue",
              "href" => "/registro/$value->cve_t_registro_ciudadano/edit"
            ],

            "Ver detalles" => [
              "icon" => "eye teal",
              "href" => "/registro/$value->cve_t_registro_ciudadano/show"
            ],
            "Suspender" => [
              "icon" => "trash red",
              "onclick" => "eliminar('$value->cve_t_registro_ciudadano')"
            ],
            "Registrar Gestión" => [
              "icon" => "trash red",
              "href" => "/registro/$value->cve_t_registro_ciudadano/Nuevagestion"
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


    public function gestiones(Request $request){

    $registro_ciudadano = Registro_Ciudadano::find($request->id_user);
    //dd($registro_ciudadano->cve_t_ciudadano);


    $gestiones = Gestiones::where([
      ['activo',1],
      ['cve_t_ciudadano',$registro_ciudadano->cve_t_ciudadano]
    ])->get();

      return $gestiones;
    }

    public function tablaGestion($id){


      setlocale(LC_TIME, 'es_ES');
      \DB::statement("SET lc_time_names = 'es_ES'");
      //$registro = Registro_Ciudadano::where('activo', '!=', 0);

      $ciudadano_query  =  ("
      SELECT
      t_ciudadano.nombre,
      t_ciudadano.paterno,
      t_ciudadano.materno,
      t_domicilio.calle_domicilio,
      t_domicilio.num_ext,
      t_domicilio.cp,
      01_t_registro_ciudadano.nombre_estructura,
      01_t_cat_telefonos.numero_telefono,
      03_cat_municipio.valor as municipio,
      01_t_gestiones.apoyo_otorgado,
      01_t_gestiones.fecha_recepcion,
      01_t_gestiones.tipo_peticion,
      01_t_gestiones.estatus

      FROM 01_t_gestiones
      INNER JOIN t_ciudadano ON t_ciudadano.cve_t_ciudadano = 01_t_gestiones.cve_t_ciudadano
      INNER JOIN t_domicilio ON t_domicilio.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
      INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
      INNER JOIN 01_t_cat_telefonos ON 01_t_cat_telefonos.cve_t_registro_ciudadano =  01_t_registro_ciudadano.cve_t_registro_ciudadano
      INNER JOIN 03_cat_municipio ON 03_cat_municipio.id = 01_t_gestiones.municipio
      WHERE 01_t_gestiones.activo = 1 AND  01_t_gestiones.cve_t_ciudadano = $id
      ");
      $gestiones = DB::select($ciudadano_query);



      $datatable = DataTables::of($gestiones)
       ->editColumn('estatus', function ($gestiones) {

        if ($gestiones->estatus == 1) {
          $estatus = 'Registrado';
        }elseif($gestiones->estatus == 2){
          $estatus = 'Entregada';
        }elseif($gestiones->estatus == 3){
          $estatus = 'En Proceso';
        }elseif($gestiones->estatus == 4){
          $estatus = 'Pendiente';
        }elseif($gestiones->estatus == 5){
          $estatus = 'Cancelada';
        }

         return $estatus;
      })
      ->editColumn('tipo_peticion', function ($gestiones) {

       if ($gestiones->tipo_peticion == 1) {
         $tipo_peticion = 'Individual';
       }elseif($gestiones->tipo_peticion == 2){
         $tipo_peticion = 'Grupal';
       }

        return $tipo_peticion;
     })

       ->editColumn('nombre', function ($gestiones) {
        return $gestiones->nombre.' '.$gestiones->paterno.' '.$gestiones->materno;
       })
       ->editColumn('calle_domicilio', function($gestiones) {
         return $gestiones->calle_domicilio.', #'.$gestiones->num_ext.','.$gestiones->cp;
       })


      ->make(true);
      //Cueri
      $data = $datatable->getData();
      foreach ($data->data as $key => $value) {

          $acciones = [

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



    public function colonia(Request $request){


      $codigoP = CodigoPostal::where([
        ['activo',1],
        ['valor',$request->cp]
      ])->get();

      foreach ($codigoP as $key => $value) {
        $cp = $value->id;
      }

    $data['colonias'] =  Colonia::where([
        ['activo',1],
        ['cp',$cp]
      ])->get();

      return $data;
    }

    public function borrar_telefono(Request $request){

      $telefono_baja = Telefonos::find($request->id);
      $telefono_baja->activo = 0;
      $telefono_baja->save();
    }

    public function borrar_red(Request $request){
      $red_baja = Red_Social::find($request->id);
      $red_baja->activo = 0;
      $red_baja->save();
    }

    public function curp(Request $request){

      $ciudadano_query  =  ("
                      SELECT
                      t_ciudadano.curp,
                      t_ciudadano.rfc,
                      t_ciudadano.created_at,
                      users.nombres,
                      users.apellidos,
                      01_t_registro_ciudadano.nombre_estructura,
                      01_t_registro_ciudadano.created_at

                      FROM t_ciudadano
                      INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
                      INNER JOIN users ON users.id = 01_t_registro_ciudadano.cve_usuario
                      WHERE t_ciudadano.activo = 1 and t_ciudadano.curp = '".$request->curp."'
      ");
      $ciudadano_curp = DB::select($ciudadano_query);

      $datos = [];

      $datos_curp = [];
      $datos_rfc = [];
      $datos_fecha = [];
      $datos_responsable = [];
      $datos_estructura = [];

      foreach ($ciudadano_curp as $key => $value) {
        $curp = $value->curp;
        $rfc = $value->rfc;
        list($fechas,$hora) = explode(" ",$value->created_at);
        $fecha = $fechas;
        $responsable = $value->nombres.' '.$value->apellidos;
        $nombre_estructura = $value->nombre_estructura;

        ////////////////////////////////////////////////////
        array_push($datos_curp,$curp);
        array_push($datos_rfc,$rfc);
        array_push($datos_fecha,$fecha);
        array_push($datos_responsable,$responsable);
        array_push($datos_estructura,$nombre_estructura);

      }



      $datos = ['curp' => $datos_curp,'rfc' => $datos_rfc,'fecha'=> $datos_fecha,'responsable'=> $datos_responsable,'estructura'=> $datos_estructura];

      return  $datos;


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

    public function suspender(Request $request){


      $ciudadano_query  =  ("
                      SELECT
                      t_ciudadano.curp,
                      t_ciudadano.rfc,
                      t_ciudadano.created_at,
                      users.nombres,
                      users.apellidos,
                      01_t_registro_ciudadano.nombre_estructura,
                      01_t_registro_ciudadano.created_at

                      FROM t_ciudadano
                      INNER JOIN 01_t_registro_ciudadano ON 01_t_registro_ciudadano.cve_t_ciudadano = t_ciudadano.cve_t_ciudadano
                      INNER JOIN users ON users.id = 01_t_registro_ciudadano.cve_usuario
                      WHERE t_ciudadano.activo = 1 and 01_t_registro_ciudadano.cve_t_registro_ciudadano = '".$request->id."'
      ");

      $ciudadano_curp = DB::select($ciudadano_query);

      $datos = [];

      $datos_curp = [];
      $datos_rfc = [];
      $datos_fecha = [];
      $datos_responsable = [];
      $datos_estructura = [];

      foreach ($ciudadano_curp as $key => $value) {
        $curp = $value->curp;
        $rfc = $value->rfc;
        list($fechas,$hora) = explode(" ",$value->created_at);
        $fecha = $fechas;
        $responsable = $value->nombres.' '.$value->apellidos;
        $nombre_estructura = $value->nombre_estructura;

        ////////////////////////////////////////////////////
        array_push($datos_curp,$curp);
        array_push($datos_rfc,$rfc);
        array_push($datos_fecha,$fecha);
        array_push($datos_responsable,$responsable);
        array_push($datos_estructura,$nombre_estructura);

      }



      $datos = ['curp' => $datos_curp,'rfc' => $datos_rfc,'fecha'=> $datos_fecha,'responsable'=> $datos_responsable,'estructura'=> $datos_estructura];

      return  $datos;

    }

    public function suspender_registro(Request $request){

      $suspender = new Suspender();
      $suspender->cve_t_registro_ciudadano = $request->id;
      $suspender->motivo = $request->motivo;
      $suspender->cve_usuario = Auth::user()->id;
      $suspender->save();

      $registro = Registro_Ciudadano::find($request->id);
      $registro->estatus = 2;
      $registro->cve_usuario = Auth::user()->id;
      $registro->save();

      return response()->json(['success'=>'Registro Suspendido exitosamente']);


    }

    public function activar_registro(Request $request){

      $registro = Registro_Ciudadano::find($request->id);
      $registro->estatus = 1;
      $registro->cve_usuario = Auth::user()->id;
      $registro->save();

      return response()->json(['success'=>'Registro Activo exitosamente']);
    }


  public function curpSubmit(Request $request){
    try {
      $endpoint = "https://sitam.tamaulipas.gob.mx/api/renapo/curp/consultar";
      $client = new \GuzzleHttp\Client();
      $headers = ['Content-Type' => 'application/json'];
      $response = $client->request('POST', $endpoint, [
        'json' => [
          'usuario' => 'appime',
          'password' => 'ggO4nsfHTog',
          'CURP' => $request->curp,
        ],
        'headers'  => $headers
      ]);

      $statusCode = $response->getStatusCode();
      $content = (string) $response->getBody();



      return $content;
    } catch (\Exception $e) {
      return array(
        "exito" => false,
        "mensaje" => $e->getMessage()
      );
    }
  }

  public function Claveelector(Request $request){

    $clave_elector = Clave_Elector::where('CVE',$request->clave_elector)->get();

    return $clave_elector;

  }

  public function Distritos(Request $request){

    //dd($request->seccion);

    $seccion_query = ("
    SELECT 03_cat_distritoLocal.valor AS distrito_local,03_cat_distritoFederal.valor AS distrito_federal FROM 03_cat_seccion
    INNER JOIN 03_cat_distritoLocal ON 03_cat_distritoLocal.id = 03_cat_seccion.cve_03_cat_distritoLocal
    INNER JOIN 03_cat_distritoFederal ON 03_cat_distritoFederal.id = 03_cat_distritoLocal.cve_03_cat_distritoFederal
    WHERE 03_cat_seccion.valor = $request->seccion
    ");

    $seccion = DB::select($seccion_query);


     return $seccion;
  }

  public function Entidades(Request $request){


    $municipio = Municipios::where([
      ['cve_ent',$request->entidad],
    ])->orderBy('cve_municipios','ASC')->get();

    return $municipio;
  }

  public function EntidadesMunicipios(Request $request){
    $estados = Entidades::where([
      ['activo',1],
      ['cve_estado',$request->estado]
    ])->get();

    $municipio = Municipios::where([
      ['cve_ent',$request->estado],
      ['cve_mun',$request->municipio],
    ])->orderBy('cve_municipios','ASC')->get();
    ///////////////////////////////////////////
    $datos = [];
    $datos_estado = [];
    $datos_municipio = [];
    //////////////////////////////////////
    array_push($datos_estado,$estados);
    array_push($datos_municipio,$municipio);
    /////////////////////////////////////
    $datos = ['entidad' => $datos_estado,'municipio' => $datos_municipio];

    return  $municipio;

  }
  // ////////////// SELECTOR //////////////////////////////////////////////////////////////////
  // public $_generales;
  //
  // public function __construct() {
  //     setlocale(LC_ALL, 'es_ES');
  //     date_default_timezone_set ('America/Mexico_City');
  //     \DB::statement("SET lc_time_names = 'es_ES'");
  //
  //     $this->_generales = new GeneralesController();
  //
  //
  // }
  //
  // public function estructura($nivel, $params = []) {
  //     $data = [];
  //
  //     if ($nivel == 0)
  //         $reg = Estructuras::where([ ['activo', 1], ['cve_usuario', 5] ])->get();
  //
  //     $data ['estructuras'] = $reg;
  //
  //       dd($data ['estructuras']);
  //
  //     return view('registro::create')->with($data);
  // }
  //
  // public function llena_combos_valores (Request $request) {
  //     $opcion = $request->opcion;
  //     $id_est = $request->id_est;
  //     $valor = $request->valor;
  //     $valor1 = $request->valor1;
  //
  //     $data = [];
  //     $query   = EstructurasNiveles::where([ ['activo', 1], ['nivel', $opcion], ['id_estructura', $id_est] ]);
  //     if($valor > 0 && $opcion == 5)
  //         $query->where('valor', $valor);
  //     $regs = $query->get();
  //
  //     foreach ($regs as $key => $value) {
  //         if($opcion == 1)
  //             $nombre = DistritoFederal::where([ ['activo', 1], ['id', $value->valor] ])->value('valor');
  //         if($opcion == 2)
  //             $nombre = DistritoLocal::where([ ['activo', 1], ['id', $value->valor] ])->value('valor');
  //         if($opcion == 3)
  //             $nombre = Zona::where([ ['activo', 1], ['id', $value->valor] ])->value('valor');
  //         if($opcion == 4)
  //             $nombre = Seccion::where([ ['activo', 1], ['id', $value->valor_hijo] ])->value('valor');
  //         if($opcion == 5)
  //             $nombre = $value->valor_hijo;
  //
  //         $data [] = [ 'id' => $value->cve_t_estructura_nivel, 'nombre' => $nombre ];
  //     }
  //     return $data;
  // }
  //
  //
  // public function ubica_valores($id) {
  //     $data = [];
  //
  //     $registro = EstructurasNiveles::find($id);
  //     $val_seccion = 0;
  //     if ($registro->nivel == 5) {
  //         $val_seccion   = Seccion::where([ ['activo', 1], ['id', $registro->valor] ])->value('valor');
  //     }
  //
  //     $valores    = [];
  //     $valores [] = [
  //                     'cve_t_estructura_nivel' => $id,
  //                     'cve_t_estructura' => $registro->cve_t_estructura,
  //                     'id_estructura' => $registro->id_estructura,
  //                     'valor' => $registro->valor,
  //                     'valor_hijo' => $registro->valor_hijo,
  //                     'valor_anterior' => $val_seccion,
  //                     'nivel' => $registro->nivel,
  //                     'id_padre' => $registro->id_padre
  //                 ];
  //     $data ['valores'] = $valores;
  //     $data ['estructura'] = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $registro->cve_t_estructura] ])->get();
  //     return $data;
  // }
  //
  // public function _estructura_seleccionada($opcion, $clave) {
  //     $data = $this->ubica_valores($clave);
  //
  //     $estructura = $data ['estructura'];
  //     foreach ($estructura as $key => $value) {
  //         $reg = Estructuras::where([ ['activo', 1], ['id_estructura', $value->id_estructura], ['id_padre', 0] ])->get();
  //         foreach ($reg as $key1 => $value1) {
  //             $nombre_estructura = $value1->nombre_estructura;
  //             $nombre_distrito = $value1->distrito_federal;
  //             $nombre_estado = Entidad::where([ ['activo', 1], ['id', $value1->cve_estado] ])->value('valor');
  //         }
  //     }
  //
  //     // desglosa valores
  //     //
  //     $valores = $data ['valores'];
  //
  //     $nombre_nivel = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $valores[0]['cve_t_estructura']],
  //                                         ['id_estructura', $valores[0]['id_estructura']]
  //                                 ])->value('descripcion');
  //
  //     $lblUno = $nombre_nivel;
  //     $nivel = $valores[0]['nivel'];
  //
  //     $lblDos = '';
  //     $valorDos = '';
  //
  //     if ($nivel == 1)
  //         $valorUno   = DistritoFederal::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');
  //
  //     if ($nivel == 2)
  //         $valorUno   = DistritoLocal::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');
  //
  //     if ($nivel == 3)
  //         $valorUno   = Zona::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');
  //
  //     if ($nivel == 4) {
  //         $valorUno   = Seccion::where([ ['activo', 1], ['id', $valores[0]['valor_hijo']],
  //                                             ['cve_03_cat_distritoLocal', $valores[0]['valor']]
  //                                         ])->value('valor');
  //     }
  //
  //     if ($nivel == 5) {
  //         $valorUno   = Seccion::where([ ['activo', 1], ['id', $valores[0]['valor']] ])->value('valor');
  //         $lblUno     = Estructuras::where([ ['activo', 1], ['cve_t_estructura', $valores[0]['id_padre']],
  //                                             ['id_estructura', $valores[0]['id_estructura']]
  //                                     ])->value('descripcion');
  //         $lblDos = $nombre_nivel;
  //         $valorDos = $valores[0]['valor_hijo'];
  //     }
  //
  //
  //     if($opcion == 1) {
  //         $data = [];
  //         $data ['label_estructura'] = 'Estructura';
  //         $data ['valor_estructura'] = $nombre_estructura;
  //         $data ['label_distrito'] = 'Distrito Federal';
  //         $data ['valor_distrito'] = $nombre_distrito;
  //         $data ['label_estado'] = 'Estado';
  //         $data ['valor_estado'] = $nombre_estado;
  //
  //         $data ['label_uno'] = $lblUno;
  //         $data ['valor_uno'] = $valorUno;
  //         $data ['label_dos'] = $lblDos;
  //         $data ['valor_dos'] = $valorDos;
  //
  //         return $data;
  //
  //     }
  //     else {
  //         $t  = <<<EOT
  //             <div class="row form-group" >
  //                 <div class="col-sm-6">
  //                     <label class="label-form w100">Nombre de la Estructura</label>
  //                     <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_estructura" />
  //                 </div>
  //                 <div class="col-sm-3">
  //                     <label class="label-form">Dist. Federal </label>
  //                     <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_distrito" />
  //                 </div>
  //                 <div class="col-sm-3">
  //                     <label class="label-form">Estado </label>
  //                     <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_estado" />
  //                 </div>
  //             </div>
  //
  //             <!-- seleccion de valores -->
  //             <div class="row form-group">
  //                 <div class="col-sm-3">
  //                     <label class="label-form w100">Nombre del nivel </label>
  //                     <input type="text" class="form-control p-3" disabled="disabled" value="$nombre_nivel" />
  //                 </div>
  //                 <div class="col-sm-3" id="ctrlUno">
  //                     <label class="label-form w100">$lblUno </label>
  //                     <input type="text" class="form-control p-3" disabled="disabled" value="$valorUno" />
  //                 </div>
  //                 <div class="col-sm-3" id="ctrlDos">
  //                     <label class="label-form w100">$lblDos </label>
  //                     <input type="text" class="form-control p-3" disabled="disabled" value="$valorDos" />
  //                 </div>
  //             </div>
  //         EOT;
  //
  //         return $t;
  //     }
  // }
  //
  //
  //
  // public function exporta_xls ($id) {
  //     $data = [];
  //     $registros = EstructurasAreas::where([ ['activo', 1], ['cve_t_estructura', $id] ])
  //                 ->orderBy('nivel', 'asc')
  //                 ->orderBy('consecutivo', 'asc')
  //                 ->orderBy('cve_t_estructura_nivel', 'asc')
  //                 ->get();
  //
  //     foreach ($registros as $key => $value) {
  //         $datos = _estructura_seleccionada(1, $value->cve_t_estructura_nivel);
  //
  //
  //         $datos ['label_estructura'] = 'Estructura';
  //         $datos ['valor_estructura'] = $nombre_estructura;
  //         $datos ['label_distrito'] = 'Distrito Federal';
  //         $datos ['valor_distrito'] = $nombre_distrito;
  //         $datos ['label_estado'] = 'Estado';
  //         $datos ['valor_estado'] = $nombre_estado;
  //
  //         $datos ['label_uno'] = $lblUno;
  //         $datos ['valor_uno'] = $valorUno;
  //         $datos ['label_dos'] = $lblDos;
  //         $datos ['valor_dos'] = $valorDos;
  //
  //
  //         $data [] = [
  //                         'id' => $value->cve_t_estructura_nivel,
  //                         'estructura' => $datos ['valor_estructura'],
  //                         'distrito' => $datos ['valor_distrito'],
  //                         'estado' => $datos ['valor_estado'],
  //                         'origen_padre' => $datos ['label_uno'],
  //                         'valor_padre' => $datos ['valor_uno'],
  //                         'nivel' => $datos ['label_dos'],
  //                         'valor' => $datos ['valor_dos'],
  //
  //                         'meta' => $value->meta,
  //                         'valor' => $datos ['valor_dos'],
  //                         'valor' => $datos ['valor_dos'],
  //                         'valor' => $datos ['valor_dos'],
  //                         'valor' => $datos ['valor_dos'],
  //                     ];
  //     }
  //     return $data;
  // }
  //
  //
  // public function llena_responsables (Request $request) {
  //     $id = $request->filtro;
  //     $regs = EstructurasResponsables::where([ ['activo', 1], ['cve_t_estructura_nivel', $id] ])
  //                 ->orderBy('cve_t_responsabilidad', 'asc')
  //                 ->get();
  //     $data = [];
  //     foreach ($regs as $key => $value) {
  //         $reg = Ciudadano::find($value->cve_t_ciudadano);
  //         if ($reg) {
  //             $nombre = ($reg) ? $reg->nombre .' ' .$reg->paterno .' ' .$reg->materno : '...';
  //             $data [] = [
  //                             'id_responsable' => $value->cve_t_estructura_responsable,
  //                             'nombre' => $nombre,
  //                             'responsabilidad' => $value->obtResponsabilidad->responsabilidad,
  //                             'id_titular' => $value->id_titular
  //                         ];
  //         }
  //     }
  //     return $data;
  // }
  //
  // public function lista_estructuras () {
  //     $regs   = Estructuras::where([ ['activo', 1], ['id_padre', 0] ])
  //             ->orderBy('id_estructura', 'asc')
  //             ->get();
  //
  //     $estructuras = [];
  //     foreach ($regs as $key0 => $value0) {
  //         $tiene = Estructuras::where([ ['activo', 1], ['id_estructura', $value0->id_estructura] ])->count();
  //
  //         if ($tiene > 1) {
  //             $registros  = Estructuras::where([ ['activo', 1], ['id_estructura', $value0->id_estructura] ])
  //                         ->orderBy('id_estructura', 'asc')
  //                         ->orderBy('consecutivo', 'asc')
  //                         ->get();
  //
  //             $anterior = 1;
  //             $texto_anterior = 'Región';
  //             $valor_anterior = 0;
  //             foreach ($registros as $key => $value) {
  //                 $valor_anterior = EstructurasNiveles::where([ ['activo', 1],
  //                                                                 ['cve_t_estructura', $value->id_padre]
  //                                                             ])->value('valor');
  //                 $nombre_estado = Entidad::where([ ['activo', 1],
  //                                                                 ['id', $value->cve_estado]
  //                                                             ])->value('valor');
  //                 $estructuras [] = array (
  //                                     'id' => $value->cve_t_estructura,
  //                                     'id_estructura' => $value->id_estructura,
  //                                     'id_padre' => $value->id_padre,
  //                                     'consecutivo' => $value->consecutivo,
  //                                     'nivel' => $value->nivel,
  //                                     'nivel_anterior' => $anterior,
  //                                     'texto_anterior' => $texto_anterior,
  //                                     'valor_anterior' => $valor_anterior,
  //                                     'cve_estado' => $value->cve_estado,
  //                                     'nombre_estado' => $nombre_estado,
  //                                     'distrito_federal' => $value->distrito_federal,
  //                                     'nombre_estructura' => $value->nombre_estructura,
  //                                     'descripcion' => $value->descripcion);
  //                 if($value->nivel < 5) {
  //                     $anterior = $value->nivel;
  //                     $texto_anterior = $value->descripcion;
  //                 }
  //             }
  //         }
  //     }
  //     // dd($regs);
  //     return $estructuras;
  // }


}
