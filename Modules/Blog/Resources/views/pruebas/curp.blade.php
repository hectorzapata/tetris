<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CURP</title>
  </head>
  <body>
    <form class="" action="/blog/pruebas/curp" method="post">
      @csrf
      <input type="text" name="curp" value="" placeholder="Escribe el CURP">
      <button type="submit">Enviar</button>
    </form>
    @isset($content)
      <div class="res">
        {{ dd( json_decode($content) ) }}
      </div>
    @endisset
  </body>
</html>
