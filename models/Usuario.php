<?php

namespace Model;

error_reporting(E_ALL); 
ini_set('display_errors', '1'); 

class Usuario extends ActiveRecord {
    // Base de datos
    protected static $tabla = "usuarios";
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];
    
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this -> id = $args['id'] ?? null;
        $this -> nombre = $args['nombre'] ?? '';
        $this -> apellido = $args['apellido'] ?? '';
        $this -> email = $args['email'] ?? '';
        $this -> password = $args['password'] ?? '';
        $this -> telefono = $args['telefono'] ?? '';
        $this -> admin = $args['admin'] ?? '0';
        $this -> confirmado = $args['confirmado'] ?? '0';
        $this -> token = $args['token'] ?? '';
    }

    // Mensajes de validación para la creación de una cuenta 
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }

        if(!$this->apellido){
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }

        if(!$this->telefono){
            self::$alertas['error'][] = 'El Telefono es Obligatorio';
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$alertas['error'][] = 'Formato de teléfono no válido';
        }

        if(!$this->email){
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'El Password es Obligatorio';
        } 

        if(strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        }


        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El Email es obligatorio'; 
        }

        if(!$this->password) {
            self::$alertas['error'][] = 'El Password es obligatorio'; 
        }

        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'El password es Obligatorio';
        }

        if(strlen($this->password) < 6 ){
            self::$alertas['error'][] = 'El Password debe tener un mínimo de 6 caracteres';
        }

        return self::$alertas;
    }


    // Revisa si el usuario ya existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla;
        $query .= " WHERE email = '" . $this -> email;
        $query .= "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado -> num_rows){
            self::$alertas['error'][] = 'El usuario ya está registrado';
        }

        return $resultado;
    }

    // Hashea los passwords
    public function hashPassword() {
        $this -> password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Crea el Token usado para la validación de la cuenta
    public function crearToken(){
        $this -> token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password, $this -> password);
        
        if(!$resultado){
            self::$alertas['error'][] = 'Password Incorrecto';
        } else if (!$this->confirmado) {
            self::$alertas['error'][] = 'Aún no has confirmado tu cuenta, por favor confirmala para continuar';
        } 
        else {
            return true;
        }
    }
}