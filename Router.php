<?php
namespace MVC;

class Router{
    public $routeGet = [];
    public $routePost = [];

    public function get($url, $fn){
        $this->routeGet[$url]= $fn;
        
    }
    public function post($url, $fn){
        $this->routePost[$url]= $fn;
        
    }

    public function checkRouter(){
        session_start();
        $auth = $_SESSION['login']??null;
        //Arreglo de rutas protegidas ...
        $protected_routes = [
            '/admin',
            '/propiedades/create',
            '/propiedades/update',
            '/propiedades/delete',
            '/vendedores/create', 
            '/vendedores/update', 
            '/vendedores/delete'];

        $currentUrl = strtok($_SERVER['REQUEST_URI'],'?')??"/";
        $method = $_SERVER['REQUEST_METHOD'];
        if($method === 'GET'){
           $fn = $this->routeGet[$currentUrl]??null;
        }else if($method === 'POST'){
            $fn = $this->routePost[$currentUrl]??null;
        }
        //*Proteger las rutas
        if(in_array($currentUrl,$protected_routes)&&!$auth){//busca si la ruta actual esta en el arreglo de las rutas protegidas
            header('Location: /');
        }
        if($fn){
            call_user_func($fn, $this);//call_user_func nos ayuda que en una forma dinamica llamemos una funcion
        }else{
            header('Location: /');
        }
    }
    //muestra una vista
    public function render($view, $datos=[]){
        foreach($datos as $key => $value){
            $$key = $value;//$$ variable de variable es como ponerle el nombre de la variable como la llave (crea varias variables)
        }
        ob_start();//?Inicia un almacenamiento en memoria
        include __DIR__."/views/$view.php"; //?ob_Start guarda esta vista

        $contenido = ob_get_clean();//limpiamos la memoria Y los datos de ob_Start se almacenan en la variable de contenido
        include __DIR__.'/views/layout.php';
    }
}