<?php
namespace Model;

class Entrada extends ActiveRecord{

    protected static $tabla = "entrada";
    protected static $columnasDB = ["id", "titulo","fecha","minutos","contenido","imagen"];
    protected static $ruta = "../public/imagenes/entradasimg/";

    public $id;
    public $titulo;
    public $fecha;
    public $minutos;
    public $contenido;
    public $imagen;

    protected $tmp_name;
    
    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->fecha = date("Y/m/d H:i:s");
        $this->minutos = $args["minutos"] ?? "";
        $this->contenido = $args["contenido"] ?? "";
        $this->imagen = $args["imagen"]?? "";
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }
    public function setTmpName($tmp_name){
        $this->tmp_name = $tmp_name;
    }
    public function validarAtributos()
    {
        $atributos = $this->mapAtributos();

        if (!$atributos["titulo"] || $atributos["titulo"] === NULL || $atributos["titulo"] == "") {
            self::$error = "Debe ingresar un titulo valido.";
        } elseif(!filter_var($atributos["minutos"], FILTER_VALIDATE_INT) || $atributos["minutos"] <= 0 || $atributos["minutos"] > 30){
            self::$error = "Las lecturas deben durar entre 1 y 30 minutos.";
        } elseif(!$atributos["contenido"] || $atributos["contenido"] === NULL || $atributos["contenido"] == ""){
            self::$error = "Debe ingresar un contenido valido para la entrada.";
        } else {
            self::$error = "";
        }

        return self::$error;
    }

    public function guardar()
    {
        //Nombrar Imagen
        $entradaNombre = "entrada".uniqid();
        $unique = uniqid();
        $extensionImagen = $this->imagen;
        $nombreImagen = $entradaNombre . "-" . $unique . $extensionImagen;
        $this->imagen = $nombreImagen;

        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO ".static::$tabla." ( ";
        $query .= join(",", array_keys($atributos));
        $query .= " ) values ( '";
        $query .= join("','", array_values($atributos));
        $query .= "' );";

        self::$db->query($query);

        //Crear Ruta
        if (!is_dir(self::$ruta)) {
            mkdir(self::$ruta, 0777, true);
        }

        //Mover Imagen al Directorio
        move_uploaded_file($this->tmp_name, self::$ruta . $nombreImagen);        
    }

    public function eliminarImagen(){       
        //Mover Imagen al Directorio
        unlink(self::$ruta . $this->imagen);
        // //Borrar Imagen en DB
        // $query = "UPDATE ".static::$tabla." SET imagen = '' WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        // self::$db->query($query);
    }

    public function eliminar(){
        $this->eliminarImagen();
        //Borrar de la base de datos
        $query = "DELETE FROM ".static::$tabla." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        self::$db->query($query);
    }

    public function actualizar()
    {
        //Nombrar Imagen
        $entradaNombre = "entrada".uniqid();
        $unique = uniqid();
        $extensionImagen = $this->imagen;
        $nombreImagen = $entradaNombre . "-" . $unique . $extensionImagen;
        $this->imagen = $nombreImagen;

        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "${key}='${value}'";
        }

        $query = "UPDATE ".static::$tabla." SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ;";
        self::$db->query($query);

        //Mover Imagen al Directorio
        move_uploaded_file($this->tmp_name, self::$ruta . $nombreImagen);        
    }
}
?>