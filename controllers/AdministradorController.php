<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Admin;

class AdministradorController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores  = Vendedor::all();
        $resultado = $_GET['resultado']??null;
        $router->render('admin/admin',[
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }
    public static function login(Router $router){
        $errores = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Admin($_POST);
            $errores = $auth->validar();
            if(empty($errores)){
                //verificar el usuario
                $usuario = $auth->findUser();
                if(!$usuario){
                    $errores = Admin::getErrores();
                }else{
                    //verificar la contraseña 
                    $autenticated=$auth->comprobarPassword($usuario);
                    if(!$autenticated){
                        $errores = Admin::getErrores();
                    }else{
                        //autenticar al usuario
                        $auth->autenticar();
                    }
                }
            }
        }
        $router->render('auth/login',[
            'errores'=>$errores
        ]);
    }
    public static function logout(){
        session_start();
        $_SESSION=[];
        header('Location: /');
    }
}