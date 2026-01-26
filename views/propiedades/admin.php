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

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>

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
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?= $propiedad->id ?>" />
                            <input type="hidden" name="tipo" value="propiedad" />
                            <input class="boton-rojo-block" type="submit" name="" value="Eliminar" />
                        </form>
                        <a href="/propiedades/actualizar?id=<?= $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados -->
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><?= $vendedor->id ?></td>
                    <td><?= $vendedor->nombre . " " . $vendedor->apellido ?></td>
                    <td><?= $vendedor->telefono ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?= $vendedor->id ?>" />
                            <input type="hidden" name="tipo" value="vendedor" />
                            <input class="boton-rojo-block" type="submit" name="" value="Eliminar" />
                        </form>
                        <a href="/vendedores/actualizar?id=<?= $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>
