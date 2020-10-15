<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class PruebasController extends Controller{
  public function curp(){
    return view('blog::pruebas.curp');
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
          'CURP' => 'ZAGH941025HTSPRC08'
        ],
        'headers'  => $headers
      ]);
      $statusCode = $response->getStatusCode();
      $content = (string) $response->getBody();
      return view('blog::pruebas.curp')->with('content', $content);
    } catch (\Exception $e) {
      return array(
        "exito" => false,
        "mensaje" => $e->getMessage()
      );
    }
  }
}
