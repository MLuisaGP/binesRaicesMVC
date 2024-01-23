<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $table = "vendedores";
    protected static $tipo = "vendedor";
    
    protected static $columnasDB = [
        "id_vendedor",
        "nombre_vendedor",
        "apellidos_vendedor",
        "telefono"];
    protected $id_vendedor;
    protected $nombre_vendedor;
    protected $apellidos_vendedor;
    protected $telefono;

    public function __construct($args=[]) {
        $this->id_vendedor          =   $args['id_vendedor']??null;
        $this->nombre_vendedor      =   $args['nombre_vendedor']??'';
        $this->apellidos_vendedor   =   $args['apellidos_vendedor']??'';
        $this->telefono             =   $args['telefono']??'';
    }
    public function definirId(){
        parent::__construct($this->id_vendedor);
    }

    public function validar(){
        if(!$this->nombre_vendedor){
           self::$errores[]="Debes añadir el nombre del vendedor";
       }
       if(!$this->apellidos_vendedor){
           self::$errores[]="Debes añadir el apellido del vendedor";
       }
       if(!$this->telefono || !preg_match('/[0-9]{10}/', $this->telefono)){
           self::$errores[]="Especifica un numero de telefono con formato correcto";
       }
    return self::$errores;
    }
}