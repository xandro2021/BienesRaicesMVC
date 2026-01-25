<fieldset>
    <legend> Información General </legend>

    <label for="nombre"> Nombre: </label>
    <input type="text" name="vendedor[nombre]" value="<?= s($vendedor->nombre) ?>" id="nombre" placeholder="Nombre Vendedor" />

    <label for="apellido"> Apellido: </label>
    <input type="text" name="vendedor[apellido]" value="<?= s($vendedor->apellido) ?>" id="apellido" placeholder="Apellido Vendedor" />

</fieldset>

<fieldset>
    <legend> Información Extra </legend>

    <label for="telefono"> Telefono: </label>
    <input type="text" name="vendedor[telefono]" value="<?= s($vendedor->telefono) ?>" id="telefono" placeholder="Telefono Vendedor" />

</fieldset>
