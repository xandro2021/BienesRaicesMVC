<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas()
    {

        $urlActual = $_SERVER['PATH_INFO'] ?? "/";
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }

        // Si la url existe
        if ($fn) {

            // Llamar de forma dinamica una funcion cuando no sabamos como se llama debido a que hay varias opciones
            call_user_func($fn, $this);
        } else {
            echo 'pagina no existe';
        }
    }

    // Muestra una vista
    public function render($view) {

        // Iniciar un almacenamiento en memoria de la vista
        ob_start();
        include __DIR__ . "/views/$view.php";

        // limpio lo que tenia en memoria
        $contenido = ob_get_clean();

        // ahora que tengo el contenido dinamico, entonces renderizo el resto
        include __DIR__ . "/views/layout.php";

    }
}
