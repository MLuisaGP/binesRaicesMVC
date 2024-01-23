<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth =$_SESSION['login']??false;
    if(!isset($inicio)){
        $inicio = false;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio':''?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img  class="logo" loading="lazy" width="200" height="300" src="/build/img/logo.svg" alt="logo bienes raices">
                </a>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="boton modo oscuro">
                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="icono menu responsivle">
                    </div>
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth):?>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif;?>
                    </nav>
                </div>
                
            </div><!--?cierre barra-->
            <?php 
            if($inicio){
                echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>";
            }
            ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
        <?php
        $fecha = date('Y'); //*y solo los ultimos 2 digitos(24); Y muestra los 4 digitos(2024)
        echo "<p class=\"copyright\">Todos los derechos Reservados $fecha </p>";
        ?>
        
    </footer>
    <script src="../build/js/bundle.min.js"></script>
</body>
</html>