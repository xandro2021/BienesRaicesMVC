<main class="contenedor seccion">
    <h1>Registrar Vendedor</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <!-- enctype es solo para cuando se vaya a subir un archivo -->
    <form class="formulario" method="POST" id="" action="/vendedores/crear" enctype="multipart/form-data">

        <?php include "formulario.php"; ?>
        <input type="submit" name="" value="Registrar Vendedor" class="boton boton-verde" />

    </form>

</main>
