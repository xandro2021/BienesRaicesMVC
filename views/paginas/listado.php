<div class="contenedor-anuncios">

    <?php foreach ($propiedades as $propiedad): ?>

        <div class="anuncio">

            <img class="adjustarImagenesAnuncios" loading="lazy" src="/imagenes/<?= $propiedad->imagen ?>" alt="anuncio casa 3" />

            <div class="contenido-anuncio">
                <h3><?= $propiedad->titulo ?></h3>
                <p><?= $propiedad->descripcion ?></p>
                <p class="precio"><?= $propiedad->precio ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img src="build/img/icono_wc.svg" alt="icono wc" loading="lazy" />
                        <p><?= $propiedad->wc  ?></p>
                    </li>

                    <li>
                        <img src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy" />
                        <p><?= $propiedad->estacionamiento  ?></p>
                    </li>

                    <li>
                        <img src="build/img/icono_dormitorio.svg" alt="icono domitorio" loading="lazy" />
                        <p><?= $propiedad->habitaciones  ?></p>
                    </li>
                </ul>

                <a class="boton-amarillo-block" href="/propiedad?id=<?= $propiedad->id ?>">Ver Propiedad</a>
            </div> <!-- contenido anuncio -->

        </div> <!-- anuncio -->

    <?php endforeach; ?>
</div> <!-- contenedor de anuncios -->
