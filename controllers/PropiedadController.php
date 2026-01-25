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

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        // Metodo POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            // Validacion
            $errores = $propiedad->validar();

            // Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                // Generar un nombre unico
                $nombreImagen = uniqid('', true);
                $extension = "." . pathinfo($_FILES['propiedad']['name']['imagen'], PATHINFO_EXTENSION);
                $nombreImagen .= $extension;

                $manager = new Image(Driver::class);
                // leer imagen
                $image = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                // guardo nombre de imagen
                $propiedad->setImagen($nombreImagen);
            }

            // Revisar que el arreglo de errores este vacío
            if (empty($errores)) {

                // si hay una imagen en la global de files
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar id
            $id = $_POST['id'];
            // se hace limpieza del input para evitar codigo malicioso
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    // Compara lo que debemos eliminar
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }

}
