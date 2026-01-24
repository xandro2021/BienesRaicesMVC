<main class="contenedor seccion">
    <h1>Administrador de bienes raíces</h1>

    <?php if ($resultado): ?>
        <?php $mensaje = mostrarNotificacion(intval($resultado)); ?>
        <?php if ($mensaje): ?>
            <p class="alerta exito">
                <?= s($mensaje); ?>
            </p>
        <?php endif; ?>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo Vendedor</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?= $propiedad->id ?></td>
                    <td><?= $propiedad->titulo ?></td>
                    <td>
                        <img src="/imagenes/<?= $propiedad->imagen ?>" class="imagen-tabla" />
                    </td>
                    <td>$ <?= $propiedad->precio ?></td>
                    <td>
                        <form method="POST" class="w-100" action="">
                            <input type="hidden" name="id" value="<?= $propiedad->id ?>" />
                            <input type="hidden" name="tipo" value="propiedad" />
                            <input class="boton-rojo-block" type="submit" name="" value="Eliminar" />
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?= $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>
