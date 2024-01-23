<fieldset><!--//*Informacion General-->
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo" value = "<?php echo sanitizar($atributosPropiedad['titulo']??"")?>" >

                <label for="precio">Precio:</label>
                <input type="number" id="precio" placeholder="Precio Propiedad" name="precio" value ="<?php echo sanitizar ($atributosPropiedad['precio']??"");?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                <!-- //*Se agrega la imagen pequeña si esta en actualizar -->
                <?php if($atributosPropiedad['imagen']):?>
                    <img  class="imagen-small" src="/imagenes/<?php echo $atributosPropiedad['imagen']?>">
                <?php endif; ?>

                <label for="descripcion">Descripción:</label>
                <textarea  id="descripcion" name="descripcion"><?php echo sanitizar($atributosPropiedad['descripcion']??"");?></textarea>
            </fieldset><!--//?Informacion General-->

            <fieldset><!--//*Informacion Propiedad-->
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ej:3" min="1" name="habitaciones" value = "<?php echo sanitizar($atributosPropiedad['habitaciones']??"");?>" >

                <label for="wc">Baños:</label>
                <input type="number" id="wc" placeholder="Ej:3" min="1" name="wc" value = "<?php echo sanitizar($atributosPropiedad['wc'])?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" placeholder="Ej:3" min="1" name="estacionamiento" value = "<?php echo sanitizar($atributosPropiedad['estacionamiento']);?>" >
            </fieldset><!--//?Informacion Propiedad-->

            <fieldset><!--//*Informacio Vendedor-->
                <legend>Vendedor</legend>

                <select name="id_vendedor" required >
                    <option <?php echo ($atributosPropiedad['id_vendedor'] == null? 'selected': '');?> value="" disabled>-- Selecionar --</option>
                    <?php foreach($vendedores as $row):                       
                    
                        $vendedor = $row->atributos(true);
                        
                        ?>
                        <option <?php echo ($atributosPropiedad['id_vendedor'] === $vendedor['id_vendedor']? 'selected': '');?> value="<?php echo ($vendedor['id_vendedor'])?>""> <?php echo ($vendedor['nombre_vendedor'].' '. $vendedor['apellidos_vendedor'])?> </option>
                    <?php endforeach;?>
                </select>

            </fieldset><!--//?Informacion Vendedor-->