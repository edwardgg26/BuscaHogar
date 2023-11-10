<?php
namespace Model;

class Propiedad extends ActiveRecord{

    protected static $columnasDB = ["id", "titulo", "precio", "ciudad_id", "vendedor_cedula", "area", "estrato", "habitaciones", "wc", "garajes"];
    protected static $tabla = "propiedad";

    public $id;
    public $titulo;
    public $precio;
    public $ciudad_id;
    public $vendedor_cedula;
    public $area;
    public $estrato;
    public $habitaciones;
    public $wc;
    public $garajes;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->ciudad_id = $args["ciudad_id"] ?? "";
        $this->vendedor_cedula = $args["vendedor_cedula"] ?? "";
        $this->area = $args["area"] ?? "";
        $this->estrato = $args["estrato"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->garajes = $args["garajes"] ?? "";
    }

    public static function consultaPorVendedor($id)
    {
        $consulta = "SELECT * FROM ".static::$tabla." WHERE vendedor_cedula = '$id';";
        $resultado = self::consultarSQL($consulta);
        return $resultado;
    }

    public function validarAtributos()
    {
        $atributos = $this->mapAtributos();

        if (!$atributos["titulo"] || $atributos["titulo"] === NULL || $atributos["titulo"] == "") {
            self::$error = "Debe ingresar un titulo.";
        } elseif (!filter_var($atributos["precio"], FILTER_VALIDATE_FLOAT) || $atributos["precio"] < 0 || $atributos["precio"] > 999999999999999) {
            self::$error = "Debe ingresar un precio valido.";
        } elseif (!filter_var($atributos["ciudad_id"], FILTER_VALIDATE_INT) || $atributos["ciudad_id"] == "null") {
            self::$error = "Debe seleccionar una ciudad.";
        } elseif (!filter_var($atributos["vendedor_cedula"], FILTER_VALIDATE_INT) || $atributos["vendedor_cedula"] == "null") {
            self::$error = "Debe seleccionar un vendedor.";
        } elseif (!filter_var($atributos["area"], FILTER_VALIDATE_FLOAT) || $atributos["area"] < 0 || $atributos["area"] > 5000) {
            self::$error = "Debe ingresar un area entre 0 y 5000 m².";
        } elseif (!filter_var($atributos["estrato"], FILTER_VALIDATE_INT) || $atributos["estrato"] <= 0 || $atributos["estrato"] > 6) {
            self::$error = "Debe ingresar un estrato de 1 a 6.";
        } elseif (!filter_var($atributos["habitaciones"], FILTER_VALIDATE_INT) || $atributos["habitaciones"] <= 0 || $atributos["habitaciones"] > 15) {
            self::$error = "Debe ingresar un número de habitaciones de 1 a 15.";
        } elseif (!filter_var($atributos["wc"], FILTER_VALIDATE_INT) || $atributos["wc"] <= 0 || $atributos["wc"] > 15) {
            self::$error = "Debe ingresar un número de baños de 1 a 15.";
        } elseif (!filter_var($atributos["garajes"], FILTER_VALIDATE_INT) || $atributos["garajes"] <= 0 || $atributos["garajes"] > 10) {
            self::$error = "Debe ingresar un número de garajes de 1 a 10.";
        } else {
            self::$error = "";
        }

        return self::$error;
    }
}
?>