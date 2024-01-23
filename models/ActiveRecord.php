<?php
namespace Model;

class ActiveRecord{
    protected static $db;
    protected static $columnasDB = [];
    protected static $table = "";
    protected static $errores=[];
    protected static $tipo = "";
    public $id;
    protected $imagen;
    
    public function __construct(string $id=null) {
        $this->id = $id;
    }
    
    public static function setDB($db){self::$db=$db;}
    public function validar(){
        return static::$errores;
    }


    public function guardar(){
        if($this->id!=null){
            $respuesta= $this->actualizar();
            $code=2;
        }else{
            
            $respuesta= $this->crear();
            $code=1;
        }
        if($respuesta){
            //redirecionar al usuario 
            header("Location: /admin?resultado=$code");
        }
    }

    protected function crear(){ 
        
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        $campos = join(', ',array_keys($atributos));
        $valores = join("', '",array_values($atributos));
        $query = "INSERT INTO ".static::$table." ($campos) VALUES ('$valores');";
        $resultado = self::$db->query($query);
        return $resultado;
    }
    protected function actualizar(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $listStr=[];
        foreach($atributos as $key=>$value){
            $listStr[] = "$key = '$value'";
        }
        $str= join(', ',$listStr);
        $id = self::$db->escape_string($this->id);
        $query="UPDATE ".static::$table." set $str where id_".static::$tipo." = '$id';";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminar(){
        //verificar si existe el id
        $this->eliminarArchivo();
        $query = "DELETE FROM ".(static::$table)." WHERE id_".static::$tipo ." = ". self::$db->escape_string($this->id);
        $resultado = self::$db->query($query);
        if($resultado){
            header('Location: /admin?resultado=3');
        }
    }
    protected function eliminarArchivo(){
        $existeArchivo = file_exists(CARPETA_IMAGENES.$this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES.$this->imagen);//?eliminar la imagen previa
        }
    }


    //Identifica y une los atributos de la BD
    public function atributos(bool $todos=false):array{
        $atributos=[];
        foreach(static::$columnasDB as $columna){
            if($columna === 'id_'.static::$tipo && !$todos) continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    protected function sanitizarAtributos():array{
        $atributos = $this->atributos();
        $sanitizado =[];
        foreach($atributos as $key=>$value){
            $sanitizado[$key]=self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //validacion
    public static function getErrores(){
        return static::$errores;
    }

    //*Listar todos los registros
    public static function all():array{
        $query = "SELECT * FROM ".static::$table;
        $resultado=self::consultarSQL($query);
        return $resultado;
    }
    public static function get(int $value):array{
        $query = "SELECT * FROM ".static::$table." LIMIT $value;";
        $resultado=self::consultarSQL($query);
        return $resultado;
    }
    //*Listar un registro
    public static function find($id){
        
        $query = "SELECT * FROM ".static::$table."  where id_".static::$tipo." = ". self::$db->escape_string($id);
        $resultado=self::consultarSQL($query);
        return array_shift($resultado);
    }

    protected static function consultarSQL($query):array{
        //Consultar la base de datos 
        $resultado = self::$db->query($query);
        //Iteral losresultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[]=static::crearObjeto($registro);
        }
        //liberar la memoria
        $resultado->free();//libera la memoria del servidor
        //retornar los resultados
        return $array;
    }

    //*Se tranforma el resulato a objetos
    protected static function crearObjeto($registro){
        $objeto = new static;
        foreach($registro as $key=>$value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        $objeto->definirId();
        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sicronizar(array $args = []){

        foreach($args as $key=>$value){
            if(property_exists($this, $key)){ 
                if($this->$key != $value){
                    $this->$key =$value;
                }
            }
        }
        $atributos = $this->atributos();
        return $atributos;
    }

    public function definirId(){}
}
