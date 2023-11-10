<?php

namespace Model;

class Admin extends ActiveRecord
{

    protected static $columnasDB = ["id", "correo", "password"];
    protected static $tabla = "usuario";

    public $id;
    public $correo;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->correo = $args["correo"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function validarAtributos()
    {
        $atributos = $this->mapAtributos();

        if (!$atributos["correo"] || $atributos["correo"] === NULL || $atributos["correo"] == "") {
            self::$error = "Debe ingresar un correo.";
        }
        if (!$atributos["password"] || $atributos["password"] === NULL || $atributos["password"] == "") {
            self::$error = "Debe ingresar la contraseña.";
        }

        return self::$error;
    }

    public function existeUsuario()
    {
        //Validar si existe el usuario
        $query = "SELECT * FROM " . self::$tabla . " WHERE correo = '" . $this->correo . "' LIMIT 1;";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        //Validar si existe el usuario
        $verificar = password_verify($this->password, $resultado->password);

        return $verificar;
    }

    public function autenticar()
    {
        session_start();

        $_SESSION["usuario"] = $this->correo;
        $_SESSION["login"] = true;

        header("Location: /admin");
    }
}

?>