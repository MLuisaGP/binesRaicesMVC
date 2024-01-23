<?php

define('FUNCIONES_URL', __DIR__ .'funciones.php');
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'].'/imagenes/');

//Escapa / Sanitizar el HTML
function sanitizar($html):string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de Contenido
function validarTipoContenido($tipo){
    $tipos =['vendedor', 'propiedad'];
    return in_array($tipo,$tipos);
}

//Muestra los mensajes

function mostrarNotificacion($codigo):string|null{
    $mensaje='';
    switch($codigo){
        case 1:
            $mensaje= 'Creado Correctamente';
        break;
        case 2:
            $mensaje= 'Actualizado Correctamente';
        break;
        case 3:
            $mensaje= 'Eliminado Correctamente';
        break;
        default:
            $mensaje= null;
    }
    return $mensaje;
}

function validarORedireccionar(string $url){
    $id =$_GET['id']; //?validar la URL por ID válido
    $id=filter_var($id,FILTER_VALIDATE_INT);
    if(!$id){
        header("Location: $url");
    }
    return $id;
}