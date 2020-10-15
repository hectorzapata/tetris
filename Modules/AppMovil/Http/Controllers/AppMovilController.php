<?php
namespace Modules\AppMovil\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\AppMovil\Entities\RegistroIne;
use Modules\Registro\Entities\Municipios;
use App\User;
/////////////////////////////////////////
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use Auth;
use \DB;
class AppMovilController extends Controller{
  public function index(){
    return view('appmovil::index');
  }
  public function edit($id){
    $data['appmovil'] = RegistroIne::find($id);
    return view('appmovil::create')->with($data);
  }
  public function update(Request $request, $id){
    try {
      //////////////////////////////////////////////////////////////////////////////
      $registro_ine = RegistroIne::find($id);
      $registro_ine->tel = $request->tel;
      $registro_ine->domicilio = $request->domicilio;
      $registro_ine->email = $request->email;
      $registro_ine->facebook = $request->facebook;
      $registro_ine->twitter = $request->twitter;
      $registro_ine->edad = $request->edad;
      $registro_ine->aregistro = $request->aregistro;
      $registro_ine->folio = $request->folio;
      $registro_ine->vigencia = $request->vigencia;
      $registro_ine->seccion = $request->seccion;
      $registro_ine->localidad = $request->localidad;
      $registro_ine->emision = $request->emision;
      $registro_ine->domicilio = $request->domicilio;
      $registro_ine->estado = $request->estado;
      $registro_ine->municipio = $request->municipio;
      $registro_ine->cve_usuario = Auth::user()->id;
      $registro_ine->save();
      //////////////////////////////////////////////////////////////////////////
      return response()->json(['success'=>'Se Actualizo con Exito']);
    } catch (\Exception $e) {
      dd($e->getMessage());
      //return response()->json(['success'=>'Successfully Added']);
    }
  }
  public function destroy(Request $request){
    $registro_ine = RegistroIne::find($request->id_registro);
    $registro_ine->activo = 0;
    $registro_ine->save();
    return response()->json(['success'=>'Eliminado exitosamente']);
  }
  public function tabla(Request $request){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    $registro = RegistroIne::with('obtUsuario')->where('05_t_ine_app.activo', 1);
    $datatable = DataTables::of($registro)
    ->editColumn('municipio', function ($registro) {
      $municipios = Municipios::where([['cve_ent',28],['cve_mun',$registro->municipio]])->get();
      foreach ($municipios as $key => $value) {
        $name_municipio = $value->nom_mun;
      }
      return $name_municipio;
    })
    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {
      $acciones = [
        "Editar" => [
          "icon" => "edit blue",
          "href" => "/appmovil/$value->cve_t_ine_app/edit"
        ],
        "Eliminar" => [
          "icon" => "trash red",
          "onclick" => "eliminar('$value->cve_t_ine_app')"
        ]
      ];
      $value->acciones = generarDropdown($acciones);
    }
    $datatable->setData($data);
    return $datatable;
  }
  public function obtener($idUsuario){
    try {
      $res = RegistroIne::where('cve_usuario', $idUsuario)->get();
      return response()->json([
        'message' => 'Registro realizado con éxito',
        'res' => $res
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Lo sentimos, ha ocurrido un error',
        'request' => $request->all(),
        'e' => $e->getMessage()
      ], 501);
    }
  }
  public function registrarIne(Request $request){
    try {
      $v = validarPiezas();
      if ( $v[0] ) {
        $registroIne = RegistroIne::create($request->all());
        return response()->json([
          'message' => 'Registro realizado con éxito',
          'registroIne' => $registroIne
        ], 201);
      }else{
        return response()->json([
          'message' => $v[1],
          'request' => $request->all()
        ], 501);
      }
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Lo sentimos, ha ocurrido un error',
        'request' => $request->all(),
        'e' => $e->getMessage()
      ], 501);
    }
  }
  public function editarIne(Request $request, $id){
    try {
      $registroIne = RegistroIne::find($id);
      $registroIne->fill($request->all());
      $registroIne->save();
      return response()->json([
        'message' => 'Registro actualizado con éxito',
        'registroIne' => $registroIne
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Lo sentimos, ha ocurrido un error',
        'request' => $request->all(),
        'e' => $e->getMessage()
      ], 501);
    }
  }
}
