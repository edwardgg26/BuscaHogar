<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Admin;
    class LoginController{

        public static function login(Router $router){

            $error = null;

            if($_SERVER["REQUEST_METHOD"] === "POST"){
                
                $auth = new Admin($_POST);

                if($auth->validarAtributos() !== ""){
                    $resultado = $auth->existeUsuario();
                    if($resultado == NULL){
                        $error = "El usuario no existe." ;
                    }else{

                        if($auth->comprobarPassword($resultado[0])){
                           $auth->autenticar(); 
                        }else{
                            $error = "La contraseña no es correcta." ;
                        }
                    }
                }else{
                    $error = $auth->validarAtributos();
                }
            }

            $router->render("/auth/login",[
                "error"=>$error
            ]);
        }
        public static function logout(){
            session_start();
            $_SESSION = [];
            header("Location: /");
        }
    }
?>