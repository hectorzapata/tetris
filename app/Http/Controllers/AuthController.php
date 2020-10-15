<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller{
  // * Registro de usuario
  public function registrar(Request $request){
    try {
      $request->validate([
        'nombres' => 'required|string',
        'apellidos' => 'required|string',
        'username' => 'required|string|unique:users',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string'
      ]);
      $data = $request->all();
      $data['password'] = bcrypt($data['password']);
      $user = User::create($data);
      return response()->json([
        'message' => 'Usuario registrado con éxito',
        'user' => $user,
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Lo sentimos, ha ocurrido un error al intentar crear el usuario'
      ], 501);
    }
  }

  // * Inicio de sesión y creación de token
  public function login(Request $request){
    try {
      $request->validate([
        'username' => 'required|string',
        'password' => 'required|string'
      ]);
      $credentials = request(['username', 'password']);
      if (!\Auth::attempt($credentials)){
        return response()->json([
          'message' => 'Unauthorized'
        ], 401);
      }
      $user = $request->user();
      $tokenResult = $user->createToken('Personal Access Token');

      $token = $tokenResult->token;
      if ($request->remember_me)
      $token->expires_at = \Carbon\Carbon::now()->addWeeks(1);
      $token->save();

      return response()->json([
        'access_token' => $tokenResult->accessToken,
        'token_type' => 'Bearer',
        'expires_at' => \Carbon\Carbon::parse($token->expires_at)->toDateTimeString(),
        'user' => $user
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Lo sentimos, ha ocurrido un error'
      ], 501);
    }
  }

  // * Cierre de sesión (anular el token)
  public function logout(Request $request){
    $request->user()->token()->revoke();
    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }

  // * Obtener el objeto User como json
  public function user(Request $request){
    return response()->json($request->user());
  }

  public function resetPasswordMail(Request $request){
    try {
      $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz!()=$';
      $user = User::where('email', $request->email)->first();
      if (!$user) {
        throw new \Exception("No existe un usuario asociado al email", 1);
      }
      $pass = substr(str_shuffle($permitted_chars), 0, 10);
      $user->password = bcrypt($pass);
      $user->save();
      $details = [
        'title' => 'Correo de SigloV',
        'body' => 'Hola, tu nueva contraseña es: ' . $pass
      ];
      \Mail::to($user->email)->send(new \App\Mail\ResetPasswordMail($details));
      return response()->json([
        'message' => 'Email enviado con éxito',
        'user' => $user
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Ha ocurrido un error al enviar el email',
        'e' => $e->getMessage()
      ], 501);
    }
  }
}
