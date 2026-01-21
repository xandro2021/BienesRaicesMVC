<?php

if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

?>

<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bienes Raices</title>
    <meta name="description" content="Pagina de inicio del sitio de bienes raíces">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preload" href="/build/css/app.min.css" as="style" />
    <link rel="stylesheet" href="/build/css/app.min.css" type="text/css" media="screen" />

</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/build/img/logo.svg" alt="Logo de bienes raíces" />
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive" />
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="modo oscuro" class="dark-mode-boton" />
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>

                        <?php if ($auth): ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>

                    </nav>
                </div>
            </div> <!-- .barra -->

            <?= $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : "" ?>
        </div>
    </header>
