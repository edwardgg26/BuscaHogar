<?php
namespace Model;
use PHPMailer\PHPMailer\PHPMailer;

class Correo
{

    public $phpmailer;
    public $nombreApellido;
    public $telefono;
    public $correoOrigen;
    public $correoDestino = "admin@bienesraices.com";
    public $asunto;
    public $mensaje;
    public static $error;
    public function __construct()
    {
        $this->phpmailer = new PHPMailer();
        $this->phpmailer->isSMTP();
        $this->phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Username = "64949fe3d42882";
        $this->phpmailer->Password = "1c217a6a0a8127";
        $this->phpmailer->SMTPSecure = "tls";
        $this->phpmailer->Port = 2525;
        $this->phpmailer->addAddress($this->correoDestino);
        $this->phpmailer->isHTML(true);
        $this->phpmailer->CharSet = "UTF-8";
    }

    function setNombreApellido($nombreApellido)
    {
        $this->nombreApellido = $nombreApellido;
    }

    function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    function setCorreoOrigen($correoOrigen)
    {
        $this->correoOrigen = $correoOrigen;
        $this->phpmailer->setFrom($correoOrigen);
    }

    function setCorreoDestino($correoDestino){
        $this->correoDestion = $correoDestino;
        $this->phpmailer->addAddress($correoDestino);
    }

    function setAsunto($asunto)
    {
        $this->asunto = $asunto;
        $this->phpmailer->Subject = $asunto;
    }

    function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    function validarAtributos($atributos)
    {
        if (!$atributos["nombreyapellido"] || $atributos["nombreyapellido"] === NULL || $atributos["nombreyapellido"] == "") {
            self::$error = "Debe ingresar un nombre y apellido.";
        } elseif ($atributos["telefono"] && (!filter_var($atributos["telefono"], FILTER_VALIDATE_INT) || !preg_match('/[0-9]{10}/', $atributos["telefono"]))) {
            self::$error = "Debe ingresar un telefono valido.";
        } elseif (!filter_var($atributos["correo"], FILTER_VALIDATE_EMAIL) || !$atributos["correo"] || $atributos["correo"] === NULL || $atributos["correo"] == "") {
            self::$error = "Debe ingresar un correo valido.";
        } elseif (!$atributos["mensaje"] || strlen($atributos["mensaje"]) < 150) {
            self::$error = "Debe ingresar un mensaje con 150 letras como minimo.";
        } else {
            self::$error = "";
        }

        return self::$error;
    }

    function enviar()
    {
        $contenido = "<html>";
        $contenido .= "<p>Nombre Completo: ". $this->nombreApellido. "</p>";
        if ($this->telefono !== "") {
            $contenido .= "<p>Telefono: ".$this->telefono."</p><br>";
        }
        $contenido .= "<p>".$this->mensaje."</p>";
        $contenido .= "</html>";

        $this->phpmailer->Body = $contenido;

        if($this->phpmailer->send()){
            $respuesta =  1;
        }else{
            $respuesta = 0;
        }

        return $respuesta;
    }
}
?>