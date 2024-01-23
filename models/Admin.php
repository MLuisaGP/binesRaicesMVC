<?php

namespace Model;

class Admin extends ActiveRecord{
    //Base de datos
    protected static $table ='usuarios'; 
    protected static $tipo ='usuario'; 
    protected static $columnasDB = [
        "id_usuario",
        "email",
        "pwd"
        ];
    protected $id_usuario;
    protected $email;
    protected $pwd;

    public function __construct($args=[]) {
        $this->id_usuario      =   $args['id_usuario']??null;
        $this->email           =   $args['email']??'';
        $this->pwd             =   $args['pwd']??'';
    }
    public function definirId(){
        parent::__construct($this->id_usuario);
    }

    public function validar(){
       if(!$this->email){
           self::$errores[]="Ingresa el email";
       }
       if(!$this->pwd){
           self::$errores[]="Ingresa una contraseña";
       }
    return self::$errores;
    }
    public function findUser(){
        $query = "SELECT * FROM ".self::$table."  where email = '".self::$db->escape_string($this->email)."'LIMIT 1";
        $resultado=self::consultarSQL($query);
        if(empty($resultado)){
            self::$errores[]="Usuario no registrado";
            return;
        }
        return array_shift($resultado);
    }
    public function comprobarPassword(Admin $admin):bool{
        $atributos=$admin->atributos();
        $pwd=$atributos['pwd'];
        $auth =password_verify($this->pwd,$pwd);
        if(!$auth){
            self::$errores[]="Contraseña no valida";
        }
        return $auth;
    }
    public function autenticar(){

        session_start();
        //Llenar el arreglo
        $_SESSION['usuario']=$this->email;
        $_SESSION['login']=true;
        header('Location: /admin');
    }
}
