<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php if ($mensaje): ?>
        <p class="alerta exito"> <?= $mensaje ?> </p>
    <?php endif; ?>

    <picture>
        <source srcset="build/img/destacada3.avif" type="image/avif" />
        <source srcset="build/img/destacada3.webp" type="image/webp" />
        <source srcset="build/img/destacada3.jpg" type="image/jpeg" />
        <img width="300" height="200" loading="lazy" src="build/img/destacada3.jpg" alt="" />
    </picture>

    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario" method="POST" id="" action="/contacto" novalidate>

        <fieldset>
            <legend> Información Personal </legend>

            <label for="nombre"> Nombre </label>
            <input type="text" id="nombre" name="contacto[nombre]" value="" placeholder="Tu Nombre" required />

            <label for="mensaje"> Mensaje </label>
            <textarea name="contacto[mensaje]" id="mensaje" rows="" cols="" tabindex="" required></textarea>

        </fieldset>

        <fieldset>
            <legend> Información sobre la propiedad </legend>

            <label for="opciones"> Vende o Compra: </label>

            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="compra"> Compra </option>
                <option value="venta"> Venta </option>
            </select>

            <label for="presupuesto"> Precio o Presupuesto </label>
            <input type="number" id="presupuesto" name="contacto[precio]" value="" placeholder="Tu Precio o Presupuesto" required />

        </fieldset>

        <fieldset>
            <legend> Contacto </legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono"> Teléfono </label>
                <input type="radio" name="contacto[contacto]" value="telefono" id="contactar-telefono" required />

                <label for="contactar-email"> Email </label>
                <input type="radio" name="contacto[contacto]" value="email" id="contactar-email" required />
            </div>

            <div id="contacto"> </div>


        </fieldset>

        <input type="submit" name="" value="Enviar" class="boton-verde" />

    </form>

</main>
