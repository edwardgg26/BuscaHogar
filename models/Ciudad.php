<?php
namespace Model;

class Ciudad extends ActiveRecord{

    protected static $tabla = "ciudad";
    protected static $columnasDB = ["id", "nombre"];

    public $id;
    public $nombre;
    
    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->nombre = $args["nombre"] ?? "";
    }

    public function validarAtributos()
    {
        $atributos = $this->mapAtributos();

        if (!$atributos["nombre"] || $atributos["nombre"] === NULL || $atributos["nombre"] == "") {
            self::$error = "Debe ingresar un nombre valido.";
        } else {
            self::$error = "";
        }

        return self::$error;
    }

}
?>