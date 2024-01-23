<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php foreach($errores as $error):?>
        <div class="alerta error">
        <?php echo( $error);?>
        </div>
    <?php endforeach;?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Tu correo electronico" id="email" require>
            <label for="pwd">Password</label>
            <input type="password" name="pwd" placeholder="Tu contraseña" id="pwd" require>
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>