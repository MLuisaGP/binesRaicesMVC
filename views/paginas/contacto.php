<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php
    if($mensaje==1){
        echo "<p class='alerta exito'>Mensaje enviado Correctamente</p>";
    }else if($mensaje==2){
        echo "<p class='alerta error'>El mensaje no se pudo enviar</p>";
    }
    ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.avif" type="image/avif">
        <img loading="lazy" src="build/img/destacada3.jpg" type="image/jpg" alt="Imagen Blog 1">
    </picture>
    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" method="POST" >
        <fieldset><!--*Informacion básica-->
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label> 
            <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre" required>
            <label for="msn">Mensaje</label>
            <textarea id="msn" name="msn" required></textarea>
          
        </fieldset><!--?Informacion básica-->
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select id="opciones" name="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="presupuesto" required>
        </fieldset>
        <fieldset>
            <legend>Contacto </legend>
            <p> Como desea ser Contactado </p>
            <div class="forma-contacto">
                <label for="contactar-llamada">Llamada</label>
                <input type="radio" name="forma_contacto" id="contactar-llamada" value="llamada" required >
                <label for="contactar-mensaje">Mensaje</label>
                <input type="radio" name="forma_contacto" id="contactar-mensaje" value="mensaje" required>
            </div>
            <div id="contacto"></div>
            
         </fieldset>
         <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>