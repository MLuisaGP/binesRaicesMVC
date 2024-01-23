<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    public static function create(Router $router){
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $atributosPropiedad = $propiedad->atributos();
        $errores = $propiedad->getErrores();

        //******************************************/
        //*                   POST                */
        //****************************************/
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $propiedad = new Propiedad($_POST);
            $atributosPropiedad = $propiedad->atributos();

            $carpetaImagenes='../../imagenes/'; //?subida de archivos
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            $nombreImagen = md5(uniqid(rand(),true)).".jpg"; //?Generar un nombre único
            if($_FILES['imagen']['tmp_name']){//?si existe esa imagen
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);//?setear la imagen
                $propiedad->setImage($nombreImagen);
            }
            $errores = $propiedad->validar();//?validamos
            if(empty($errores)){
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                $image->save(CARPETA_IMAGENES.$nombreImagen);
                $propiedad->guardar();
            }
        }
        $router->render('/propiedades/create',[
            'atributosPropiedad'=>$atributosPropiedad,
            'vendedores'=>$vendedores,
            'errores'=>$errores
        ]);
    }

    public static function update(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $atributosPropiedad = $propiedad->atributos(true);
        $vendedores = Vendedor::all();
        $errores = $propiedad->getErrores();

        //******************************************/
        //*                   POST                */
        //****************************************/
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $atributosPropiedad=$propiedad->sicronizar($_POST);//? Sincronizamos y obtenemos los atributos ya sincronizados
            $errores = $propiedad->validar(); //* validamos el formulario
            
            if(empty($errores)){
                $nombreImagen = md5(uniqid(rand(),true)).".jpg"; //?Generar un nombre único 
                
                if($_FILES['imagen']['tmp_name']){//?si existe esa imagen
                    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);//?crear la imagen
                    $propiedad->setImage($nombreImagen);//?insertar el nombre de la imgen en propiedad
                    $image->save(CARPETA_IMAGENES.$nombreImagen);
                }
                $propiedad->guardar();
            }
        }
        $router->render('/propiedades/update',[
            'atributosPropiedad' => $atributosPropiedad,
            'vendedores'=>$vendedores,
            'errores'=>$errores
        ]);
    }

    public static function delete(Router $router){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id){
                $tipo = $_POST['type'];
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }else{
                    header("Location: /admin");
                }
            }
        }
    }
}