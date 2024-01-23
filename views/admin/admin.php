<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <!--//*Alerta de mensaje-->
    <?php
        if($resultado){
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje){
    ?>
                <p class="alerta exito"><?php echo sanitizar($mensaje);?></p>
    <?php 
            }
        }
    ?>
    <a href="/propiedades/create" class="boton boton-verde">Nueva propiedad</a>
    <a href="/vendedores/create" class="boton boton-amarillo">Registrar Vendedor</a>
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
        <tbody> <!--//*Mostrar los resultados-->
        <?php foreach($propiedades as $row):
            $atributosPropiedad = $row->atributos(true);
            
            ?>
            <tr>
                <td><?php echo$atributosPropiedad['id_propiedad'];?></td>
                <td><?php echo$atributosPropiedad['titulo'];?></td>
                <td class="imagen-tabla"><img src="/imagenes/<?php echo$atributosPropiedad['imagen'];?>" alt="imagen-tabla"></td>
                <td>$<?php echo$atributosPropiedad['precio'];?></td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/delete">
                        <input type="hidden" name="id" value="<?php echo$atributosPropiedad['id_propiedad'];?>">
                        <input type="hidden" name="type" value="propiedad">
                        <input type="submit" class='boton-rojo-block' value="Eliminar">
                    </form>
                    <a href="/propiedades/update?id=<?php echo$atributosPropiedad['id_propiedad'];?>" class='boton-amarillo-block'>Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--//*Mostrar los resultados-->
        <?php foreach($vendedores as $row):
            $atributosVendedores = $row->atributos(true);
            
            ?>
            <tr>
                <td><?php echo $atributosVendedores['id_vendedor'];?></td>
                <td><?php echo $atributosVendedores['nombre_vendedor'].' '.$atributosVendedores['apellidos_vendedor'];?></td>
                <td><?php echo $atributosVendedores['telefono'];?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/delete">
                        <input type="hidden" name="id" value="<?php echo $atributosVendedores['id_vendedor'];?>">
                        <input type="hidden" name="type" value="vendedor">
                        <input type="submit" class='boton-rojo-block' value="Eliminar">
                    </form>
                    <a href="/vendedores/update?id=<?php echo $atributosVendedores['id_vendedor'];?>" class='boton-amarillo-block'>Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>