<?php

namespace App\Classes;
/**
 * Trait para facilitar el retorno de respuestas con los parámetros
 *    necesarios para notificaciones
 */
trait Notificaciones {

    function notificacion_($style = "success", $titulo = "", $mensaje = "", $extras = []) {
        $exito = ($style = "success") ? true : false;

        return response()->json(array_merge([
            "exito" => $exito,
            "titulo" => $titulo,
            "mensaje" => $mensaje,
            "style" => $style,
            "icon" => "check"
        ], $extras), 200, ['Content-Type' => 'application/json;charset=utf8'], JSON_UNESCAPED_UNICODE);
    }

}
