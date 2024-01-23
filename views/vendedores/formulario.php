<fieldset><!--//*Informacion General-->
                <legend>Informacion General</legend>

                <label for="nombre_vendedor">Nombre:</label>
                <input type="text" id="nombre_vendedor" placeholder="Nombre del Vendedor" name="nombre_vendedor" value = "<?php echo sanitizar($atributosVendedor['nombre_vendedor']??"")?>" >

                <label for="apellidos_vendedor">Apellidos:</label>
                <input type="text" id="apellidos_vendedor" placeholder="Apellidos del Vendedor" name="apellidos_vendedor" value = "<?php echo sanitizar($atributosVendedor['apellidos_vendedor']??"")?>" >
</fieldset><!--//?Informacion General-->
<fieldset><!--//*Informacion extra-->
                <legend>Informacion Extra</legend>

                <label for="telefono">Telefono:</label>
                <input type="tel" id="telefono" placeholder="Telefono del Vendedor" name="telefono" value = "<?php echo sanitizar($atributosVendedor['telefono']??"")?>" >
</fieldset><!--//?Informacion General-->