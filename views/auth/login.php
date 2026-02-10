<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?= $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" id="" action="/login" >

        <fieldset>
            <legend>Email y Password</legend>

            <label for="email"> Email </label>
            <input type="email" id="email" name="email" value="" placeholder="Tu Email" required />

            <label for="password"> Password </label>
            <input type="password" id="password" name="password" value="" placeholder="Tu Password" required />

        </fieldset>

        <input type="submit" name="" value="Iniciar Sesión" class="boton boton-verde" />

    </form>

</main>
