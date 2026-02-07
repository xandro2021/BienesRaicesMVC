<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio,
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades,
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad,
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            /* crear una instancia de PHPMailer */
            $mail = new PHPMailer(true);

            // Configurar el protocolo de envio de emails SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '3537774955d187';
            $mail->Password = '9c214ca0a10db7';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;

            // Configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            // Habilitar el html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido = '<html>';
            $contenido .= "<p>Nombre: {$respuestas['nombre']}</p>";

            // Enviar de forma condicional algunos campos de email o telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por teléfono</p>';
                $contenido .= "<p>Telefono: {$respuestas['telefono']}</p>";
                $contenido .= "<p>Fecha de contacto: {$respuestas['fecha']}</p>";
                $contenido .= "<p>Hora: {$respuestas['hora']}</p>";
            } else {
                // Es email, agregamos campos de email
                $contenido .= '<p>Eligió ser contactado por email</p>';
                $contenido .= "<p>Email: {$respuestas['email']}</p>";
            }

            $contenido .= "<p>Mensaje: {$respuestas['mensaje']}</p>";
            $contenido .= "<p>Vende o Compra: {$respuestas['tipo']}</p>";
            $contenido .= "<p>Precio o Presupuesto: $ {$respuestas['precio']}</p>";
            $contenido .= "<p>Prefiere ser contactado por: {$respuestas['contacto']}</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';

            // Enviar el email
            try {
                // configuración
                $mail->send();
                $mensaje = "Mensaje enviado correctamente";
            } catch (Exception $e) {
                $mensaje = "Error al enviar el mensaje: {$mail->ErrorInfo}";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje,
        ]);
    }
}
