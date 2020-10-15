<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CatalogosController extends Controller{
  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function index(){
    return view('catalogos::index');
  }

  /**
   * Show the form for creating a new resource.
   * @return Renderable
   */
  public function create($catalogo){
    $data['catalogo'] = $catalogo;
    $arreglo = $this->getCatalogos($catalogo);
    $dropdown = [];
    foreach ($arreglo["campos"] as $llave => $valor) {
      if ( array_key_exists('dropdown', $valor) ) {
        $drop = $valor['dropdown'];
        $tmp = \App::make($drop['modelo']);
        if ( count($drop['condiciones']) > 0 ) {
          foreach ($drop['condiciones'] as $key => $value) {
            $tmp = $tmp->where($value[0], $value[1], $value[2]);
          }
          $dropdown[$llave] = $tmp->get();
        }
      }
    }
    $data['dropdown'] = $dropdown;
    $data['arreglo'] = $arreglo;
    return view('catalogos::catalogos.create')->with($data);
  }
  public function createSecciones(){
    $catalogo = "secciones";
    $data['catalogo'] = $catalogo;
    $arreglo = $this->getCatalogos($catalogo);
    $dropdown = [];
    $tmp = \Modules\Catalogos\Entities\DistritoLocal::with('obtMunicipio')->where('activo', '!=', '0')->get();
    foreach ($tmp as $key => $value) {
      $value['valor'] = $value['valor'] . " " . $value->obtMunicipio->valor . " DF: " . $value->cve_03_cat_distritoFederal;
    }
    $dropdown['cve_03_cat_distritoLocal'] = $tmp;
    $data['dropdown'] = $dropdown;
    $data['arreglo'] = $arreglo;
    return view('catalogos::catalogos.create')->with($data);
  }

  /**
   * Store a newly created resource in storage.
   * @param Request $request
   * @return Renderable
   */
  public function store(Request $request, $catalogo){
    try {
      $arreglo = $this->getCatalogos($catalogo);
      $obj = "\Modules\Catalogos\Entities\\" . $arreglo["modelo"];
      $obj = \App::make($obj);
      $obj = $obj::create($request->all());
      flash($arreglo['label'] . ' registrad' . $arreglo['sexo'] . ' con éxito')->success();
      return redirect("/catalogos/$catalogo/index");
    } catch (\Exception $e) {
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar crear el registro";
      if ( strpos($request->server->get('HTTP_HOST'), "localhost") !== false ) {
        $mensaje .= "| " . $e->getMessage();
      }
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }

  /**
   * Show the form for editing the specified resource.
   * @param int $id
   * @return Renderable
   */
  public function edit($catalogo, $id){
    try {
      $dropdown = [];
      $arreglo = $this->getCatalogos($catalogo);
      $obj = "\Modules\Catalogos\Entities\\" . $arreglo["modelo"];
      $obj = \App::make($obj);
      $data['data'] = $obj::find($id);
      $data['arreglo'] = $arreglo;
      $data['catalogo'] = $catalogo;
      foreach ($arreglo["campos"] as $llave => $valor) {
        if ( array_key_exists('dropdown', $valor) ) {
          $drop = $valor['dropdown'];
          $tmp = \App::make($drop['modelo']);
          if ( count($drop['condiciones']) > 0 ) {
            foreach ($drop['condiciones'] as $key => $value) {
              $tmp = $tmp->where($value[0], $value[1], $value[2]);
            }
            $dropdown[$llave] = $tmp->get();
          }
        }
      }
      $data['dropdown'] = $dropdown;
      return view('catalogos::catalogos.create')->with($data);
    } catch (\Exception $e) {
      $pre = $arreglo['sexo'] == "a" ? "la" : "el";
      flash('Lo sentimos, ha ocurrido un error al intentar editar ' . $pre . ' ' . strtolower($arreglo["label"]))->warning();
      return back();
    }
  }
  public function editSecciones($id){
    try {
      $dropdown = [];
      $catalogo = "secciones";
      $data['catalogo'] = $catalogo;
      $arreglo = $this->getCatalogos($catalogo);
      $dropdown = [];
      $tmp = \Modules\Catalogos\Entities\DistritoLocal::with('obtMunicipio')->where('activo', '!=', '0')->get();
      foreach ($tmp as $key => $value) {
        $value['valor'] = $value['valor'] . " " . $value->obtMunicipio->valor . " DF: " . $value->cve_03_cat_distritoFederal;
      }
      $dropdown['cve_03_cat_distritoLocal'] = $tmp;
      $data['dropdown'] = $dropdown;
      $data['arreglo'] = $arreglo;
      $data['data'] = \Modules\Catalogos\Entities\Seccion::find($id);
      return view('catalogos::catalogos.create')->with($data);
    } catch (\Exception $e) {
      $pre = $arreglo['sexo'] == "a" ? "la" : "el";
      flash('Lo sentimos, ha ocurrido un error al intentar editar ' . $pre . ' ' . strtolower($arreglo["label"]))->warning();
      return back();
    }
  }

  /**
   * Update the specified resource in storage.
   * @param Request $request
   * @param int $id
   * @return Renderable
   */
  public function update(Request $request, $catalogo, $id){
    try {
      $arreglo = $this->getCatalogos($catalogo);
      $obj = "\Modules\Catalogos\Entities\\" . $arreglo["modelo"];
      $obj = \App::make($obj);
      $obj = $obj::find($id);
      $obj->fill($request->all());
      $obj->save();
      flash($arreglo['label'] . ' actualizad' . $arreglo['sexo'] . ' con éxito')->success();
      return redirect("/catalogos/$catalogo/index");
    } catch (\Exception $e) {
      $pre = $arreglo['sexo'] == "a" ? "la" : "el";
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar actualizar $pre " . strtolower($arreglo['label']);
      flash($mensaje)->warning();
      return back()->withInput($request->input());
    }
  }

  /**
   * Remove the specified resource from storage.
   * @param int $id
   * @return Renderable
   */
  public function destroy($catalogo, $id){
    try {
      $arreglo = $this->getCatalogos($catalogo);
      $obj = "\Modules\Catalogos\Entities\\" . $arreglo["modelo"];
      $obj = \App::make($obj);
      $obj = $obj::find($id);
      $obj->activo = 0;
      $obj->save();
      flash($arreglo['label'] . ' eliminad' . $arreglo['sexo'] . ' con éxito')->success();
      return redirect("/catalogos/$catalogo/index");
    } catch (\Exception $e) {
      $pre = $arreglo['sexo'] == "a" ? "la" : "el";
      $mensaje = "Lo sentimos, ha ocurrido un error al intentar eliminar $pre " . strtolower($arreglo['label']);
      flash($mensaje)->warning();
      return back();
    }
  }

  public function catalogo($catalogo){
    try {
      $data['arreglo'] = $this->getCatalogos($catalogo);
      $data['catalogo'] = $catalogo;
      return view('catalogos::catalogos.index')->with($data);
    } catch (\Exception $e) {
      echo 'Lo sentimos, ha ocurrido un error'; die();
    }
  }

  public function tabla(Request $request, $catalogo){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    $arreglo = $this->getCatalogos($catalogo);
    $datatable = \Yajra\Datatables\Datatables::of(\DB::select($arreglo['tabla']));
    $datatable = $datatable->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {
      $acciones = [
        "Editar" => [
          "icon" => "edit blue",
          "href" => "/catalogos/$catalogo/$value->id/edit"
        ],
        "Eliminar" => [
          "icon" => "trash red",
          "onclick" => "eliminar('$value->id')"
        ]
      ];
      $value->acciones = generarDropdown($acciones);
    }
    $datatable->setData($data);
    return $datatable;
  }

  public function getCatalogos($llave = false){
    $arreglo = [
      "entidades" => [
        "breadcumb" => "Todas las entidades",
        "label" => "Entidad",
        "modelo" => "Entidad",
        "sexo" => "a",
        "tabla" => "select * from 03_cat_entidad",
        "orden" => "[[1, 'asc']]",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Entidad",
            "placeholder" => "Escribe la entidad",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la entidad' }"
          ]
        ]
      ],
      "distritosfederales" => [
        "breadcumb" => "Todos los distritos federales",
        "label" => "Distrito federal",
        "modelo" => "DistritoFederal",
        "sexo" => "o",
        "tabla" => "select f.id, f.valor, m.valor as cve_03_cat_municipio from 03_cat_distritoFederal f inner join 03_cat_municipio m on m.id = f.cve_03_cat_municipio",
        "orden" => "[[1, 'asc']]",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Distrito Federal",
            "placeholder" => "Escribe el distrito federal",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el distrito federal' }"
          ],
          "cve_03_cat_municipio" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Municipio cabecera",
            "placeholder" => "Selecciona el municipio cabecera",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona el municipio cabecera' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\Municipio",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ],
        ]
      ],
      "distritoslocales" => [
        "breadcumb" => "Todos los distritos locales",
        "label" => "Distrito local",
        "modelo" => "DistritoLocal",
        "sexo" => "o",
        "tabla" => "select d.id, d.valor, f.valor as cve_03_cat_distritoFederal, m.valor as cve_03_cat_municipio from 03_cat_distritoLocal d left join 03_cat_distritoFederal f on d.cve_03_cat_distritoFederal = f.id left join 03_cat_municipio m on d.cve_03_cat_municipio = m.id",
        "orden" => "[[1, 'asc']]",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Distrito local",
            "placeholder" => "Escribe el distrito local",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el distrito local' }"
          ],
          "cve_03_cat_distritoFederal" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Distrito Federal",
            "placeholder" => "Selecciona el distrito federal",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona el distrito federal' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\DistritoFederal",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ],
          "cve_03_cat_municipio" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Municipio",
            "placeholder" => "Selecciona el municipio",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona el municipio' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\Municipio",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ],
        ]
      ],
      "secciones" => [
        "breadcumb" => "Todas las secciones",
        "label" => "Sección",
        "modelo" => "Seccion",
        "sexo" => "a",
        "tabla" => "select s.id, s.valor, l.valor as cve_03_cat_distritoLocal, l.cve_03_cat_distritoFederal, m.valor as cve_03_cat_municipio from 03_cat_seccion s inner join 03_cat_distritoLocal l on l.id = s.cve_03_cat_distritoLocal inner join 03_cat_municipio m on m.id = l.cve_03_cat_municipio",
        "orden" => "[[1, 'asc']]",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Sección",
            "placeholder" => "Escribe la sección",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la sección' }"
          ],
          "cve_03_cat_distritoLocal" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Distrito Local",
            "placeholder" => "Selecciona el distrito local",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona el distrito local' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\DistritoLocal",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor", [
                "etiqueta" => "Distrito Federal",
                "valor" => "cve_03_cat_distritoFederal"
              ]]
            ]
          ],
          "cve_03_cat_distritoFederal" =>[
            "form" => false,
            "label" => "Distrito Federal",
          ],
          "cve_03_cat_municipio" =>[
            "form" => false,
            "label" => "Municipio",
          ],
        ]
      ],
      "zonas" => [
        "breadcumb" => "Todas las zonas",
        "label" => "Zona",
        "modelo" => "Zona",
        "sexo" => "a",
        "tabla" => "select * from 03_cat_zona",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Zona",
            "placeholder" => "Escribe la zona",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la zona' }"
          ]
        ]
      ],
      "casillas" => [
        "breadcumb" => "Todas las casillas",
        "label" => "Casilla",
        "modelo" => "Casilla",
        "sexo" => "a",
        "tabla" => "select c.id, s.valor as cve_03_cat_seccion, cc.valor as cve_03_cat_claseCasilla, c.valor, l.valor as cve_03_cat_lugar from 03_cat_casilla c inner join 03_cat_seccion s on c.cve_03_cat_seccion = s.id inner join 03_cat_claseCasilla cc on c.cve_03_cat_claseCasilla = cc.id inner join 03_cat_lugar l on c.cve_03_cat_lugar = l.id",
        "orden" => "[[0, 'asc']]",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "cve_03_cat_seccion" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Seccion",
            "placeholder" => "Selecciona la sección",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona una sección' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\Seccion",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ],
          "cve_03_cat_claseCasilla" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Clase",
            "placeholder" => "Selecciona la clase de casilla",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona la clase de casilla' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\ClaseCasilla",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Casilla",
            "placeholder" => "Escribe la casilla",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la casilla' }"
          ],
          "cve_03_cat_lugar" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Domicilio de la casilla",
            "placeholder" => "Selecciona el domicilio de la casilla",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona el domicilio de la casilla' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\Lugar",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ],
        ]
      ],
      "lugares" => [
        "breadcumb" => "Todos los lugares",
        "label" => "Lugar",
        "modelo" => "Lugar",
        "sexo" => "o",
        "tabla" => "select c.id, c.valor, c.ubicacion, t.valor as cve_03_cat_tipoDomicilioCasilla from 03_cat_lugar c inner join 03_cat_tipoDomicilioCasilla t on c.cve_03_cat_tipoDomicilioCasilla = t.id",
        "orden" => "[[0, 'asc']]",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Lugar",
            "placeholder" => "Escribe el lugar",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el lugar' }"
          ],
          "localidad_manzana" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Localidad Manzana",
            "hiddenTabla" => true,
            "placeholder" => "Escribe la localidad manzana",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la localidad manzana' }"
          ],
          "ubicacion" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Ubicación",
            "placeholder" => "Escribe la ubicación",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la ubicación' }"
          ],
          "referencia" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Referencia",
            "hiddenTabla" => true,
            "placeholder" => "Escribe la referencia",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la referencia' }"
          ],
          "cve_03_cat_tipoDomicilioCasilla" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Tipo domicilio",
            "placeholder" => "Selecciona el tipo de domicilio",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona un tipo de domicilio' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\TipoDomicilioCasilla",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ],
        ]
      ],
      "regiones" => [
        "breadcumb" => "Todas las regiones",
        "label" => "Región",
        "modelo" => "Region",
        "sexo" => "a",
        "tabla" => "select * from 03_cat_region",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Región",
            "placeholder" => "Escribe la región",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la región' }"
          ]
        ]
      ],
      "municipios" => [
        "breadcumb" => "Todos las municipios",
        "label" => "Municipio",
        "modelo" => "Municipio",
        "sexo" => "o",
        "tabla" => "select a.id, a.valor, b.valor as entidad from 03_cat_municipio a left join 03_cat_entidad b on a.entidad = b.id",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Municipio",
            "placeholder" => "Escribe el municipio",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el municipio' }"
          ],
          "entidad" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Entidad",
            "placeholder" => "Selecciona la entidad",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona una entidad' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\Entidad",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ]
        ]
      ],
      "colonias" => [
        "breadcumb" => "Todas las colonias",
        "label" => "Colonia",
        "modelo" => "Colonia",
        "sexo" => "a",
        "tabla" => "select c.id, c.valor, p.valor as cp from 03_cat_colonia c inner join 03_cat_codigoPostal p on c.cp = p.id",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Colonia",
            "placeholder" => "Escribe la colonia",
            "validacion" => "notEmpty: { message: 'Por favor, escribe la colonia' }"
          ],
          "cp" =>[
            "form" => true,
            "tipo" => "dropdown",
            "label" => "Código Postal",
            "placeholder" => "Selecciona el código postal",
            "validacion" => "notEmpty: { message: 'Por favor, selecciona un código postal' }",
            "dropdown" => [
              "modelo" => "\Modules\Catalogos\Entities\CodigoPostal",
              "condiciones" => [ ["activo","!=", "0"] ],
              "llaves" => [ "id", "valor" ]
            ]
          ]
        ]
      ],
      "codigopostal" => [
        "breadcumb" => "Todos los codigos postales",
        "label" => "Código Postal",
        "modelo" => "CodigoPostal",
        "sexo" => "o",
        "tabla" => "select * from 03_cat_codigoPostal",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Código Postal",
            "placeholder" => "Escribe el código postal",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el código postal' }"
          ]
        ]
      ],
      "rangosedad" => [
        "breadcumb" => "Todos los rangos de edad",
        "label" => "Rango de edad",
        "modelo" => "RangoEdad",
        "sexo" => "o",
        "tabla" => "select * from 03_cat_rangoEdad",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Rango de edad",
            "placeholder" => "Escribe el rango de edad",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el rango de edad' }"
          ]
        ]
      ],
      "gestores" => [
        "breadcumb" => "Todos los gestores",
        "label" => "Gestor",
        "modelo" => "Gestor",
        "sexo" => "o",
        "tabla" => "select * from 03_cat_gestor",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Gestor",
            "placeholder" => "Escribe el nombre del gestor",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el nombre del gestor' }"
          ]
        ]
      ],
      "tipogestiones" => [
        "breadcumb" => "Todos los tipos de gestiones",
        "label" => "Tipo de gestión",
        "modelo" => "tipoGestion",
        "sexo" => "o",
        "tabla" => "select * from 03_cat_tipoGestion",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Tipo de gestión",
            "placeholder" => "Escribe el tipo de gestión",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el tipo de gestión' }"
          ]
        ]
      ],
      "motivollamada" => [
        "breadcumb" => "Todos los motivos de llamada",
        "label" => "Motivo de llamada",
        "modelo" => "MotivoLlamada",
        "sexo" => "o",
        "tabla" => "select * from 03_cat_motivoLlamada",
        "campos" => [
          "id" => [
            "form" => false,
            "label" => "Id"
          ],
          "valor" =>[
            "form" => true,
            "tipo" => "text",
            "label" => "Motivo de llamada",
            "placeholder" => "Escribe el motivo de llamada",
            "validacion" => "notEmpty: { message: 'Por favor, escribe el motivo de llamada' }"
          ]
        ]
      ],
    ];
    if ($llave === false) return $arreglo;
    if ( !array_key_exists($llave, $arreglo) ) throw new \Exception("El catálogo no existe", 1);
    return $arreglo[$llave];
  }
}
