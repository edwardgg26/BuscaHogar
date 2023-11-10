<?php
namespace Model;

class ActiveRecord
{
    protected static $db;
    protected static $error;
    protected static $columnasDB = [];
    protected static $tabla = "";

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function guardar()
    {
        $atributos = $this->sanitizarAtributos();
        $query = "INSERT INTO ".static::$tabla." ( ";
        $query .= join(",", array_keys($atributos));
        $query .= " ) values ( '";
        $query .= join("','", array_values($atributos));
        $query .= "' );";

        self::$db->query($query);
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
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ;";
        self::$db->query($query);
    }

    public function eliminar()
    {
        $query = "DELETE FROM ".static::$tabla." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        self::$db->query($query);
    }

    public function mapAtributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna === "id")
                continue;

            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }
    
    public function sanitizarAtributos()
    {
        $atributos = $this->mapAtributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Consultas
    public static function consultaListado()
    {
        $consulta = "SELECT * FROM ".static::$tabla.";";
        $resultado = self::consultarSQL($consulta);

        return $resultado;
    }

    public static function consultaListadoDesc()
    {
        $consulta = "SELECT * FROM ".static::$tabla." ORDER BY id DESC; ";
        $resultado = self::consultarSQL($consulta);

        return $resultado;
    }

    public static function consultaListadoDescLimit(int $limite)
    {
        $consulta = "SELECT * FROM ".static::$tabla." ORDER BY id DESC LIMIT ${limite}; ";
        $resultado = self::consultarSQL($consulta);

        return $resultado;
    }

    public static function consultaPorId($id)
    {
        $consulta = "SELECT * FROM ".static::$tabla." WHERE id = '$id';";
        $resultado = self::consultarSQL($consulta);

        return $resultado[0];
    }

    public static function consultaUltimo()
    {
        $consulta = "SELECT * FROM ".static::$tabla." ORDER BY id DESC LIMIT 1;";
        $resultado = self::consultarSQL($consulta);

        return $resultado[0];
    }

    public static function consultaPersonalizada($datos){
        $consulta = "SELECT * FROM ".static::$tabla;
        $mapAtributos = transformarArreglo($datos);
        $aux = 0;
        
        foreach($mapAtributos as $key => $value){
            if($value !== "null" && $value !== "" && $value !== null){

                //Agregar WHERE solo una vez
                if($aux == 0){
                    $consulta.= " WHERE 1 = 1 ";
                    $aux = 1;
                }
                //Validar si voy a ingresar un valor fijo
                if(is_int($value) && strpos($key,"_minimo") === false && strpos($key,"_maximo") === false){
                    $consulta.= " AND ${key} = ${value} ";
                }
                //Validar si voy a ingresar un valor con minimo
                if(is_int($value)  && strpos($key,"_minimo") !== false){
                    $key = str_replace("_minimo","",$key);
                    $consulta.= " AND ${key} >= ${value} ";
                }
                //Validar si voy a ingresar un valor con maximo
                if(is_int($value) && strpos($key,"_maximo") !== false){
                    $key = str_replace("_maximo","",$key);
                    $consulta.= " AND ${key} <= ${value} ";
                }
                //Validar si voy a ingresar un string
                if(is_string($value)){
                    $consulta.= " AND ${key} LIKE '%${value}%' ";
                }
            }
        }
        $consulta.= " ;";
        $resultado = self::consultarSQL($consulta);

        return $resultado;
    }

    //Realizar Consulta y retornar objetos
    public static function consultarSQL($query)
    {
        $resultado = self::$db->query($query);

        $arreglo = [];

        while ($row = $resultado->fetch_assoc()) {
            $arreglo[] = static::crearObjeto($row);
        }

        $resultado->free();

        return $arreglo;
    }

    //Crear objeto de propiedad
    protected static function crearObjeto($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

    public function sincronizar($arreglo = [])
    {
        foreach ($arreglo as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
?>