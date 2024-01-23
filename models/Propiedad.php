<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $table = "propiedades";
    protected static $tipo = "propiedad";
    protected static $columnasDB = [
        "id_propiedad",
        "titulo",
        "precio",
        "imagen",
        "descripcion",
        "habitaciones",
        "wc",
        "estacionamiento",
        "fch_creado",
        "id_vendedor"
        ];
    protected $id_propiedad;
    protected $titulo;
    protected $precio;
    protected $imagen;
    protected $descripcion;
    protected $habitaciones;
    protected $wc;
    protected $estacionamiento;
    protected $fch_creado;
    protected $id_vendedor;

    public function __construct($args=[]) {
        
        $this->id_propiedad     =   $args['id_propiedad']??null;
        $this->id               =   $this->id_propiedad;
        $this->titulo           =   $args['titulo']??'';
        $this->precio           =   $args['precio']??'';
        $this->imagen           =   $args['imagen']??'';
        $this->descripcion      =   $args['descripcion']??'';
        $this->habitaciones     =   $args['habitaciones']??'';
        $this->wc               =   $args['wc']??'';
        $this->estacionamiento  =   $args['estacionamiento']??'';
        $this->fch_creado       =   date('Y-m-d');
        $this->id_vendedor      =   $args['id_vendedor']??'';
    }

    public function setImage($imagen){
        
        if($this->id_propiedad!=null){
            $existeArchivo = file_exists(CARPETA_IMAGENES.$this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES.$this->imagen);//?eliminar la imagen previa
            }
        }
        if($imagen) {
            $this->imagen = $imagen;
        }
    }




    public function validar(){
        if(!$this->titulo){
           self::$errores[]="Debes añadir un titulo";
       }
       if(!$this->precio){
           self::$errores[]="Debes añadir un precio";
       }
       if(!$this->habitaciones){
           self::$errores[]="El Numero de habitaciones es obligatorio";
       }
       if(!$this->wc){
           self::$errores[]="El Numero de baños es obligatorio";
       }
       if(!$this->estacionamiento){
           self::$errores[]="El Numero de estacionamiento es obligatorio";
       }
       if(!$this->id_vendedor){
           self::$errores[]="Debes selecionar un vendedor";
       }
       if(!$this->imagen ){
           self::$errores[]="Debes adjuntar una imagen";
       }
    return self::$errores;
    }

    public function definirId(){
        parent::__construct($this->id_propiedad);
    }

}