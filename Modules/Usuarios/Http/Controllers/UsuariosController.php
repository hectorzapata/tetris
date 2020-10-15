<?php

namespace Modules\Usuarios\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use \App\User;
use \Carbon\Carbon;

class UsuariosController extends Controller{
  /**
  * Display a listing of the resource.
  * @return Renderable
  */
  public function index(){
    return view('usuarios::index');
  }

  /**
  * Show the form for creating a new resource.
  * @return Renderable
  */
  public function create(){
    return view('usuarios::create');
  }

  /**
  * Store a newly created resource in storage.
  * @param Request $request
  * @return Renderable
  */
  public function store(Request $request){
    try {
      $usuario = User::create($request->all());
      $usuario->password = bcrypt($usuario->password);
      $usuario->save();
      flash('Usuario registrado con éxito')->success();
      return redirect('/usuarios');
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar crear el usuario";
      switch ($e->getCode()) {
        case '23000':
          if ( str_contains($e->getMessage(), 'users_email_unique') ) {
            $mensaje = "Lo sentimos, ya existe un usuario registrado con el email " . $request->email;
          }else if( str_contains($e->getMessage(), 'users_username_unique') ){
            $mensaje = "Lo sentimos, ya existe un usuario registrado con el username " . $request->username;
          }
          break;
      }
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }

  /**
  * Show the specified resource.
  * @param int $id
  * @return Renderable
  */
  public function show($id){
    return view('usuarios::show');
  }

  /**
  * Show the form for editing the specified resource.
  * @param int $id
  * @return Renderable
  */
  public function edit($id){
    try {
      $usuario = User::find($id);
      return view('usuarios::usuarios.create')->with('usuario', $usuario);
    } catch (\Exception $e) {
      flash('Lo sentimos, ha ocurrido un error al intentar editar el usuario')->warning();
      return back();
    }
  }

  /**
  * Update the specified resource in storage.
  * @param Request $request
  * @param int $id
  * @return Renderable
  */
  public function update(Request $request, $id){
    try {
      $data = $request->all();
      $usuario = User::find($id);
      unset($data["passwordconfirm"]);
      if ( is_null($data["password"]) ) {
        unset($data["password"]);
      }else{
        $data["password"] = bcrypt($data["password"]);
      }
      $usuario->fill($data);
      $usuario->save();
      flash('Usuario actualizado con éxito')->success();
      return redirect('/usuarios');
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar el usuario";
      switch ($e->getCode()) {
        case '23000':
          if ( str_contains($e->getMessage(), 'users_email_unique') ) {
            $mensaje = "Lo sentimos, ya existe un usuario registrado con el email " . $request->email;
          }else if( str_contains($e->getMessage(), 'users_username_unique') ){
            $mensaje = "Lo sentimos, ya existe un usuario registrado con el username " . $request->username;
          }
          break;
      }
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }

  /**
  * Remove the specified resource from storage.
  * @param int $id
  * @return Renderable
  */
  public function destroy($id){
    //
  }

  public function tabla(Request $request){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    $users = User::where('activo', '!=', 0);
    $datatable = DataTables::of($users)
    ->editColumn('created_at', function ($user) {
      return $user->created_at ? ucwords(Carbon::parse($user->created_at)->formatLocalized('%d %B %Y')) : '';
    })
    ->editColumn('nombres', function ($user) {
      return $user->nombres;
    })
    ->filterColumn('nombres', function($query, $keyword) {
      $query->whereRaw("CONCAT(users.nombres, users.apellidos) like ?", ["%{$keyword}%"]);
    })
    ->filterColumn('created_at', function ($query, $keyword) {
      $query->whereRaw("DATE_FORMAT(created_at,'%d %M %Y') like ?", ["%$keyword%"]);
    })
    ->editColumn('objectguid', function($user) {
      return [
        'display' => ( is_null($user->objectguid) ) ? "Invitado" : "Directorio Activo",
        'sorteable' => $user->objectguid
      ];
    })
    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {
      $acciones = [
        "Editar" => [
          "icon" => "edit blue",
          "href" => "/usuarios/$value->id/edit"
        ],
        "Permisos" => [
          "icon" => "key green",
          "href" => "/usuarios/$value->id/permisos"
        ],
        "Ver detalles" => [
          "icon" => "eye teal",
          "href" => "/usuarios/$value->id/show"
        ],
        "Eliminar" => [
          "icon" => "trash red",
          "onclick" => "eliminar('$value->id')"
        ]
      ];
      if ( !permiso('ms001', 'Asignar permisos') ) {
        unset($acciones['Permisos']);
      }
      if ( !permiso('ms001', 'Ver detalles de usuario') ) {
        unset($acciones['Ver detalles']);
      }
      if ( !permiso('ms001', 'Eliminar usuario') ) {
        unset($acciones['Eliminar']);
      }
      $value->acciones = generarDropdown($acciones);
    }
    $datatable->setData($data);
    return $datatable;
  }
}
