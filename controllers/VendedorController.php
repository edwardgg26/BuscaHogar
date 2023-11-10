<?php
    namespace Controllers;
    use MVC\Router;
    use Model\Vendedor;
    use Model\Propiedad;
    use Model\Imagen;

    class VendedorController{
        public static function listado(Router $router){
            $resultado = $_GET["resultado"] ?? null;
            $vendedores = Vendedor::consultaListado();


            $router->render("/vendedores/listado",[
                "resultado"=> $resultado,
                "vendedores"=> $vendedores
            ]);
        }

        public static function crear(Router $router){
            $vendedor = new Vendedor;

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $vendedor = new Vendedor($_POST);
            
                if ($vendedor->validarAtributos() === "") {
                    
                    $vendedor -> guardar();
            
                    header("Location: listado?resultado=1");
                }
            }

            $router->render("/vendedores/crear",[
                "vendedor"=>$vendedor
            ]);
        }

        public static function actualizar(Router $router){
            $id = validarORedireccionar("listado");
            $vendedor = Vendedor::consultaPorId($id);

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $args = [];
                $args["cedula"] = $_POST["cedula"]??null;
                $args["nombre"] = $_POST["nombre"]??null;
                $args["apellido"] = $_POST["apellido"]??null;
                $args["telefono"] = $_POST["telefono"]??null;
                $args["correo"] = $_POST["correo"]??null;
            
                $vendedor->sincronizar($args);
            
                //Verificar que no haya errores y actualizar
                if ($vendedor->validarAtributos() === "") {
                    $vendedor->actualizar();
                    header("Location: listado?resultado=2");      
                }
            }

            $router->render("/vendedores/actualizar",[
                "vendedor"=>$vendedor
            ]);
        }

        public static function borrar(Router $router){
            $id = validarORedireccionar("listado");
            $vendedor = Vendedor::consultaPorId($id);
            $propiedades = Propiedad::consultaPorVendedor($id);

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                foreach($propiedades as $propiedad){
                    $imagenes = Imagen::consultaPorPropiedad($propiedad->id);
            
                    foreach ($imagenes as $imagen){
                        //Borrar cada imagen de la propiedad
                        $imagen->eliminarImagen($imagen->id);
                    }
            
                    $propiedad->eliminar();
                }
                
                $vendedor->eliminar();
                header("Location: listado?resultado=3");
            }

            $router->render("/vendedores/borrar",[
                "vendedor"=>$vendedor
            ]);
        }
    }
?>