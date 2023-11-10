<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Ciudad;

    class CiudadController{

        public static function listado(Router $router){

            $resultado = $_GET["resultado"] ?? null;
            $ciudades = Ciudad::consultaListado();

            $router->render("/ciudades/listado",[
                "resultado"=>$resultado,
                "ciudades"=>$ciudades
            ]);
        }

        public static function crear(Router $router){

            $ciudad = new Ciudad;

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $ciudad = new Ciudad($_POST);
            
                if ($ciudad->validarAtributos() === "") {
                    
                    $ciudad -> guardar();
                    header("Location: listado?resultado=1");
                }
            }

            $router->render("/ciudades/crear",[
                "ciudad" => $ciudad
            ]);
        }

        public static function actualizar(Router $router){
            $id = validarORedireccionar("listado");
            $ciudad = Ciudad::consultaPorId($id);

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $args = [];
                $args["nombre"] = $_POST["nombre"]??null;
            
                $ciudad->sincronizar($args);
            
                //Verificar que no haya errores y actualizar
                if ($ciudad->validarAtributos() === "") {
                    $ciudad->actualizar();
                    header("Location: listado?resultado=2");      
                }
            }

            $router->render("/ciudades/actualizar",[
                "ciudad" => $ciudad
            ]);
        }
    }
?>