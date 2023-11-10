<?php
namespace Model;

class Vendedor extends ActiveRecord{

    protected static $tabla = "vendedor";
    protected static $columnasDB = ["cedula", "nombre", "apellido", "telefono", "correo"];

    public $cedula;
    public $nombre;
    public $apellido;
    public $telefono;
    public $correo;
    
    public function __construct($args = [])
    {
        $this->cedula = $args["cedula"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
        $this->correo = $args["correo"] ?? "";
    }

    public function validarAtributos()
    {
        $atributos = $this->mapAtributos();

        if (!filter_var($atributos["cedula"], FILTER_VALIDATE_INT) || $atributos["cedula"] <= 1000000 || $atributos["cedula"] > 99999999999) {
            self::$error = "Debe ingresar una cedula valida.";
        } else{
            error_reporting(0);
            $vendedor = self::consultaPorId($atributos["cedula"]);

            if(!is_null($vendedor)){
                self::$error = "Ya existe un vendedor registrado con esa cedula.";
            } elseif (!$atributos["nombre"] || $atributos["nombre"] === NULL || $atributos["nombre"] == "") {
                self::$error = "Debe ingresar un nombre.";
            } elseif (!$atributos["apellido"] || $atributos["apellido"] === NULL || $atributos["apellido"] == "") {
                self::$error = "Debe ingresar un apellido.";
            } elseif ( $atributos["telefono"] && (!filter_var($atributos["telefono"], FILTER_VALIDATE_INT) || !preg_match('/[0-9]{10}/',$atributos["telefono"]))) {
                self::$error = "Debe ingresar un telefono valido.";
            } elseif (!filter_var($atributos["correo"], FILTER_VALIDATE_EMAIL) || !$atributos["correo"] || $atributos["correo"] === NULL || $atributos["correo"] == "") {
                self::$error = "Debe ingresar un correo valido.";
            } else {
                self::$error = "";
            }
        }

        return self::$error;
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "${key}='${value}'";
        }

        $query = "UPDATE ".static::$tabla." SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE cedula = '" . self::$db->escape_string($this->cedula) . "' ";
        $query .= "LIMIT 1 ;";
        self::$db->query($query);
    }
    public function eliminar()
    {
        $query = "DELETE FROM ".static::$tabla." WHERE cedula = " . self::$db->escape_string($this->cedula) . " LIMIT 1;";
        self::$db->query($query);
    }

    public static function consultaPorId($id)
    {
        $consulta = "SELECT * FROM ".static::$tabla." WHERE cedula = '$id';";
        $resultado = self::consultarSQL($consulta);

        return $resultado[0];
    }
}
?>