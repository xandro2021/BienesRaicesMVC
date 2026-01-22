<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas() {

        $urlActual = $_SERVER['PATH_INFO'] ?? "/";
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }

        // Si la url existe
        if ($fn) {

            // Llamar de forma dinamica una funcion cuando no sabamos como se llama debido a que hay varias opciones
            call_user_func($fn, $this);
        }
        else {
            echo 'pagina no existe';
        }

    }

}
