<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function create(Router $router){
        $vendedor = new Vendedor();
        $atributosVendedor = $vendedor->atributos();
        $errores = $vendedor->getErrores();

        //******************************************/
        //*                   POST                */
        //****************************************/
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $vendedor = new Vendedor($_POST);
            $atributosVendedor = $vendedor->atributos();

            $errores = $vendedor->validar();//?validamos
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        $router->render('/vendedores/create',[
            'atributosVendedor'=>$atributosVendedor,
            'errores'=>$errores
        ]);
    }

    public static function update(Router $router){
        
        $id = validarORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        $atributosVendedor = $vendedor->atributos(true);
        $errores = $vendedor->getErrores();

        //******************************************/
        //*                   POST                */
        //****************************************/
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $atributosVendedor=$vendedor->sicronizar($_POST);//? Sincronizamos y obtenemos los atributos ya sincronizados
            $errores = $vendedor->validar(); //* validamos el formulario
            
            if(empty($errores)){
                $vendedor->guardar();
            }
        }
        $router->render('/vendedores/update',[
            'atributosVendedor' => $atributosVendedor,
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
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }else{
                    header("Location: /admin");
                }
            }
        }
    }
}