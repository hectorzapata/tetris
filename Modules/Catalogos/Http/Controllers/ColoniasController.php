<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Catalogos\Entities\Colonia;

class ColoniasController extends Controller{

    public function obtenerPorCP($cp){
        $colonias = Colonia::where('cp', $cp)->get(['id', 'valor', 'cp']);
        return response()->json($colonias);
    }

}