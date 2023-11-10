<?php 

    namespace Controllers;
    use Model\Correo;
    use MVC\Router;
    use Model\Propiedad;
    use Model\Entrada;
    use Model\Ciudad;
    use Model\Vendedor;
    use Model\Imagen;

    class PublicController{

        public static function index(Router $router){

            $inicio = true;
            $propiedades = Propiedad::consultaListadoDescLimit(3);
            $entradas = Entrada::consultaListadoDescLimit(3);

            $router->render("/paginas/index",[
                "inicio" =>$inicio,
                "propiedades"=>$propiedades,
                "entradas"=>$entradas
            ]);
        }

        public static function nosotros(Router $router){
            $router->render("/paginas/nosotros");
        }

        public static function propiedades(Router $router){

            $propiedades = Propiedad::consultaListadoDesc();

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                
                $propiedades = [];
                $propiedades = Propiedad::consultaPersonalizada($_POST);
            }

            $router->render("/paginas/propiedades",[
                "propiedades"=>$propiedades
            ]);
        }

        public static function propiedad(Router $router){
            $id = validarORedireccionar("/");
            $propiedad = Propiedad::consultaPorId($id);   
            $imagenes = Imagen::consultaPorPropiedad($id);
            $ciudad = Ciudad::consultaPorId($propiedad->ciudad_id);
            $vendedor = Vendedor::consultaPorId($propiedad->vendedor_cedula);

            $respuesta = null;
            $errorValidacion = "";

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $correo = new Correo;
                $errorValidacion = $correo->validarAtributos($_POST);

                if($errorValidacion === ""){
                    $correo->setCorreoOrigen($_POST["correo"]);
                    $correo->setCorreoDestino($vendedor->correo);
                    $correo->setAsunto('Persona interesada por la propiedad "'.$propiedad->titulo.'"');
                    $correo->setNombreApellido($_POST["nombreyapellido"]);
                    $correo->setTelefono($_POST["telefono"]);
                    $correo->setMensaje($_POST["mensaje"]);
                    $respuesta = $correo->enviar();
                }
            }

            $router->render("/paginas/propiedad",[
                "propiedad"=>$propiedad,
                "imagenes"=>$imagenes,
                "ciudad"=>$ciudad,
                "vendedor"=>$vendedor,
                "errorValidacion" => $errorValidacion,
                "respuesta"=>$respuesta
            ]);
        }

        public static function blog(Router $router){
            $entradas = Entrada::consultaListadoDesc();

            $router->render("/paginas/blog",[
                "entradas"=>$entradas
            ]);
        }

        public static function entrada(Router $router){
            $id = validarORedireccionar("/");
            $entrada = Entrada::consultaPorId($id);   

            $router->render("/paginas/entrada",[
                "entrada"=>$entrada
            ]);
        }

        public static function contacto(Router $router){

            $respuesta = null;
            $errorValidacion = "";

            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $correo = new Correo;
                $errorValidacion = $correo->validarAtributos($_POST);

                if($errorValidacion === ""){
                    $correo->setCorreoOrigen($_POST["correo"]);
                    $correo->setAsunto("Contacto Bienes Raices");
                    $correo->setNombreApellido($_POST["nombreyapellido"]);
                    $correo->setTelefono($_POST["telefono"]);
                    $correo->setMensaje($_POST["mensaje"]);
                    $respuesta = $correo->enviar();
                }
            }

            $router->render("/paginas/contacto",[
                "respuesta" => $respuesta,
                "errorValidacion"=>$errorValidacion
            ]);
        }
    }
?>