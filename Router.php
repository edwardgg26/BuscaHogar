<?php

namespace MVC;

class Router
{
    public $rutasGet = [];
    public $rutasPost = [];

    public function get($url,$funcion){
        $this->rutasGet[$url] = $funcion;
    }

    public function post($url,$funcion){
        $this->rutasPost[$url] = $funcion;
    }

    public function __construct()
    {

    }

    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION["login"]??null;

        $rutas_protegidas = ["/admin",
                            "/propiedades/listado",
                            "/propiedades/crear",
                            "/propiedades/actualizar",
                            "/propiedades/borrar",
                            "/vendedores/listado",
                            "/vendedores/crear",
                            "/vendedores/actualizar",
                            "/vendedores/borrar",
                            "/ciudades/listado",
                            "/ciudades/crear",
                            "/ciudades/actualizar",
                            "/entradas/listado",
                            "/entradas/crear",
                            "/entradas/actualizar",
                            "/entradas/borrar"];

        $urlActual = $_SERVER["PATH_INFO"]??"./";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $funcion = $this->rutasGet[$urlActual]??null;
        }

        if($metodo === "POST"){
            $funcion = $this->rutasPost[$urlActual]??null;
        }

        if(in_array($urlActual,$rutas_protegidas) && !$auth){
            header("Location: /login");
        }

        if($funcion){
            call_user_func($funcion,$this);
        }else{
            echo "Pagina no encontrada";
        }
    }

    public function render($vista,$datos = []){

        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start();
        include_once __DIR__."/views/${vista}.php";
        $contenido = ob_get_clean();
        include_once __DIR__."/views/layout.php";
    }
}

?>