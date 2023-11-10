<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Model\Ciudad;
    use Model\Imagen;

    class PropiedadController{

        public static function listado(Router $router){

            $propiedades = Propiedad::consultaListadoDesc();
            $vendedores = Vendedor::consultaListado();
            $ciudades = Ciudad::consultaListado();
            $resultado = $_GET["resultado"] ?? null;

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                
                $propiedades = [];
                debugear($_SERVER);
                $propiedades = Propiedad::consultaPersonalizada($_POST);
            }

            $router->render("/propiedades/listado",[
                "propiedades" => $propiedades,
                "resultado" => $resultado,
                "vendedores"=>$vendedores,
                "ciudades"=>$ciudades
            ]);
        }

        public static function crear(Router $router){
            $propiedad = new Propiedad;
            $vendedores = Vendedor::consultaListado();
            $ciudades = Ciudad::consultaListado();
            $imagenesPropiedad = null;

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $imagenesPropiedad = $_FILES["imagenesPropiedad"];

                $propiedad = new Propiedad($_POST);
            
                if (validarImagen($imagenesPropiedad) === "" && $propiedad->validarAtributos() === "") {
                    
                    $propiedad -> guardar();
                    $ultimaPropiedad = Propiedad::consultaUltimo();
            
                    foreach ($imagenesPropiedad["tmp_name"] as $key => $value) {
                        $mapImagen = ["nombre" => $imagenesPropiedad["name"][$key],"propiedad_id" => $ultimaPropiedad->id];
                        $imagen = new Imagen($mapImagen);
                        $imagen->setTmpName($imagenesPropiedad["tmp_name"][$key]);
                        $imagen->guardar();
                    }
            
                    header("Location: listado?resultado=1");
                }
            }

            $router->render("/propiedades/crear",[
                "propiedad" => $propiedad,
                "vendedores"=>$vendedores,
                "ciudades"=>$ciudades,
                "imagenesPropiedad"=>$imagenesPropiedad
            ]);
        }
        public static function actualizar(Router $router){
            
            $id = validarORedireccionar("listado");
            $propiedad = Propiedad::consultaPorId($id);
            $vendedores = Vendedor::consultaListado();
            $ciudades = Ciudad::consultaListado();
            $imagenes = Imagen::consultaPorPropiedad($id);

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $imagenesPropiedad = $_FILES["imagenesPropiedad"];
            
                $args = [];
                $args["titulo"] = $_POST["titulo"]??null;
                $args["precio"] = $_POST["precio"]??null;
                $args["ciudad_id"] = $_POST["ciudad_id"]??null;
                $args["vendedor_cedula"] = $_POST["vendedor_cedula"]??null;
                $args["area"] = $_POST["area"]??null;
                $args["estrato"] = $_POST["estrato"]??null;
                $args["habitaciones"] = $_POST["habitaciones"]??null;
                $args["wc"] = $_POST["wc"]??null;
                $args["garajes"] = $_POST["garajes"]??null;
            
                $propiedad->sincronizar($args);
            
                $error="";
                $errorImagenNueva = false;
            
                //Verificar si voy a borrar imagenes
                if (!empty($_POST["imagenAEliminar"])) {
                    if(sizeof($_POST["imagenAEliminar"]) === sizeof($imagenes) && $imagenesPropiedad["name"][0] === ""){
                        $error = "No puede borrar todas las imagenes si no va a ingresar una nueva.";
                    }else{
                        //Recorrer imagenes
                        $indice = 0;
                        foreach ($imagenes as $imagen){
                            //Comprobar si el id de la imagen es igual al del arreglo "Imagenes a eliminar"
                            if( $imagen->id == $_POST["imagenAEliminar"][$indice]){
                                $imagen->eliminar();
                                $indice+=1;
                            }
                        }
                    }
                }
                
                //Verificar si voy a subir imagenes nuevas
                if($imagenesPropiedad["name"][0] !== "" && validarImagen($imagenesPropiedad) === ""){
                    foreach ($_FILES["imagenesPropiedad"]["tmp_name"] as $key => $value) {
                        $mapImagen = ["nombre" => $imagenesPropiedad["name"][$key],"propiedad_id" => $id];
                        $imagen = new Imagen($mapImagen);
                        $imagen->setTmpName($imagenesPropiedad["tmp_name"][$key]);
                        $imagen->guardar();
                    }
                }elseif($imagenesPropiedad["name"][0] !== "" && validarImagen($imagenesPropiedad) !== ""){
                    $errorImagenNueva = true;
                }
            
                //Verificar que no haya errores y actualizar
                if ($propiedad->validarAtributos() === "" && $error==="" && $errorImagenNueva === false) {
                    $propiedad->actualizar();
                    header("Location: listado?resultado=2");      
                }
            }

            $router->render("/propiedades/actualizar",[
                "propiedad" => $propiedad,
                "vendedores"=>$vendedores,
                "ciudades"=>$ciudades,
                "imagenes"=>$imagenes
            ]);
        }

        public static function borrar(Router $router){
            $id = validarORedireccionar("listado");
            $propiedad = Propiedad::consultaPorId($id);
            $imagenes = Imagen::consultaPorPropiedad($id);
            $vendedor = Vendedor::consultaPorId($propiedad->vendedor_cedula);
            $ciudad = Ciudad::consultaPorId($propiedad->ciudad_id);

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                foreach ($imagenes as $imagen){
                    //Borrar cada imagen de la propiedad
                    $imagen->eliminar();
                }
            
                $propiedad->eliminar();
                header("Location: listado?resultado=3");
            }

            $router->render("/propiedades/borrar",[
                "propiedad" => $propiedad,
                "vendedor"=>$vendedor,
                "ciudad"=>$ciudad,
                "imagenes"=>$imagenes
            ]);
        }
    }

?>