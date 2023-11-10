<?php
namespace Model;

class Imagen extends ActiveRecord
{
    protected static $columnasDB = ["id", "nombre", "propiedad_id"];
    protected static $tabla = "imagen";
    protected static $ruta = "../public/imagenes/propiedadesimg/";
    public $id;
    public $nombre;
    public $propiedad_id;
    protected $tmp_name;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? '';
        $this->nombre = $args["nombre"]??'';
        $this->propiedad_id = $args["propiedad_id"]??'';
    }

    public function setTmpName($tmp_name){
        $this->tmp_name = $tmp_name;
    }
    public function guardar()
    {

        //Crear Ruta
        if (!is_dir(self::$ruta)) {
            mkdir(self::$ruta, 0777, true);
        }
        //Nombrar Imagen
        $propiedadNombre = "propiedad" . $this->propiedad_id;
        $unique = uniqid();
        $extensionImagen = $this->nombre;
        $nombreImagen = $propiedadNombre . "-" . $unique . $extensionImagen;

        //Mover Imagen al Directorio

        move_uploaded_file($this->tmp_name, self::$ruta . $nombreImagen);

        //Insertar en DB
        $insertarImagen = "INSERT INTO imagen (nombre , propiedad_id) values ('$nombreImagen','$this->propiedad_id');";
        self::$db->query($insertarImagen);
    }

    public function eliminar()
    {
        //Consultar imagen
        $resultado = self::consultaPorId($this->id);

        //Borrarla del directorio
        unlink(self::$ruta . $resultado->nombre);

        //Borrarla de la base de datos    
        $consulta = "DELETE FROM ".static::$tabla." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        self::$db->query($consulta);
    }

    public static function consultaPorPropiedad($id)
    {
        $consulta = "SELECT * FROM " . static::$tabla . " WHERE propiedad_id = '$id';";
        $resultado = self::consultarSQL($consulta);
        return $resultado;
    }
}


?>