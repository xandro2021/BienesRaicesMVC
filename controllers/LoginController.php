<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{

    public static function login(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                // Verificar que el usuario exista
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    // Error de usuario inexistente
                    $errores = Admin::getErrores();
                } else {
                    // Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        // Autenticar el usuario
                        $auth->autenticar();
                    } else {
                        // Error de password incorrecto
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores,
        ]);
    }

    public static function logout()
    {
        session_start();
        // Elimino los datos de la session
        $_SESSION = [];

        // Redirecciono a la pagina principal
        header('Location: /');
    }
}
