<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Entrada;

    class EntradaController{
        public static function listado(Router $router){
            $resultado = $_GET["resultado"] ?? null;
            $entradas = Entrada::consultaListadoDesc();

            $router->render("/entradas/listado",[
                "resultado"=>$resultado,
                "entradas"=>$entradas
            ]);
        }

        public static function crear(Router $router){

            $entrada = new Entrada;
            $imagenEntrada = null;

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                //Crear Post
                $imagenEntrada =  mapearArregloImagen($_FILES["imagenEntrada"]);
                //Crear Objeto
                $entrada = new Entrada($_POST);

                if ( validarImagen($imagenEntrada) === "" && $entrada->validarAtributos() === "") {
                    $entrada->setImagen($imagenEntrada["name"][0]);
                    $entrada->setTmpName($imagenEntrada["tmp_name"][0]);
                    $entrada -> guardar();

                    header("Location: listado?resultado=1");
                }
            }
            
            $router->render("/entradas/crear",[
                "entrada" => $entrada,
                "imagenEntrada" => $imagenEntrada
            ]);
        }
        public static function actualizar(Router $router){
            $id = validarORedireccionar("listado");
            $entrada = Entrada::consultaPorId($id);
            $imagenEntrada = null;
            $errorImagen = null;

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $imagenEntrada = mapearArregloImagen($_FILES["imagenEntrada"]);
            
                $args = [];
                $args["titulo"] = $_POST["titulo"]??null;
                $args["minutos"] = $_POST["minutos"]??null;
                $args["contenido"] = $_POST["contenido"]??null;
            
                $entrada->sincronizar($args);

                //Verificar si voy a cambiar imagen
                if($imagenEntrada["name"][0] !== "" && validarImagen($imagenEntrada) === ""){
                    $entrada->eliminarImagen();
                    $entrada->setImagen($imagenEntrada["name"][0]);
                    $entrada->setTmpName($imagenEntrada["tmp_name"][0]);
                }elseif($imagenEntrada["name"][0] !== "" && validarImagen($imagenEntrada) !== ""){
                    $errorImagen = true;
                }
            
                if (!$errorImagen && $entrada->validarAtributos() === "") {
                    $entrada -> actualizar();
                    header("Location: listado?resultado=2");
                }
            }

            $router->render("/entradas/actualizar",[
                "entrada"=>$entrada,
                "imagenEntrada" => $imagenEntrada,
                "errorImagen" => $errorImagen
            ]);
        }
        public static function borrar(Router $router){
            $id = validarORedireccionar("listado");
            $entrada = Entrada::consultaPorId($id);

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $entrada->eliminar();
                header("Location: listado?resultado=3");
            }

            $router->render("/entradas/borrar",[
                "entrada"=>$entrada
            ]);
        }
    }
?>