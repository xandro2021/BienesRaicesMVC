<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();


        // Ejecutar el codigo despues del que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $propiedad = new Propiedad($_POST['propiedad']);

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                // Generar un nombre unico
                $nombreImagen = uniqid('', true);
                $extension = "." . pathinfo($_FILES['propiedad']['name']['imagen'], PATHINFO_EXTENSION);
                $nombreImagen .= $extension;

                $manager = new Image(Driver::class);
                // leer imagen
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                // guardo nombre de imagen
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            // Revisar que el arreglo de errores este vacío
            if (empty($errores)) {

                /* SUBIDA DE ARCHIVOS */

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
        ]);
    }

    public static function actualizar()
    {
        echo "Actualizar Propiedad";
    }
}
