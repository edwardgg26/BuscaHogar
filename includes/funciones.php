<?php
define("FUNCIONES_URL", "funciones.php");

//Verificar Autenticacion
function isAuth(): void
{
    session_start();

    if (!$_SESSION["login"]) {
        header("Location: /buscahogar/login.php");
    }
}

function mapearArregloImagen($arregloImagen){
    foreach ($arregloImagen as $key => $value) {
        $arregloNuevo[$key] = [$value];        
    }

    return $arregloNuevo;
}

//Validar Imagen
function validarImagen($arregloImagen)
{
    //Tamaño maximo de 4MB
    $tamanoMaximo = (1000 * 1000) * 4;
    foreach ($arregloImagen["tmp_name"] as $key => $value) {
        
        if ($arregloImagen["name"][$key] === "") {
            return "Debe Ingresar una imagén";
        }
        if ($arregloImagen["type"][$key] != "image/jpeg" && $arregloImagen["type"][$key] != "image/png") {
            return "Solo se admiten imagenes PNG y JPG.";
        }
        if ($arregloImagen["size"][$key] > $tamanoMaximo) {
            return "El tamaño maximo para las imagenes es de 4MB.";
        }
    }

    return "";
}

function debugear($variable): void
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function sanitizar($html)
{
    $san = htmlspecialchars($html);
    return $san;
}

function validarORedireccionar(string $url)
{
    $idSelec = $_GET["id"];
    $idSelec = filter_var($idSelec, FILTER_VALIDATE_INT);

    if (!$idSelec) {
        header("Location: ${url}");
    }

    return $idSelec;
}

function transformarArreglo($arreglo){

    $arregloNuevo = [];
    foreach($arreglo as $key => $value){
        
        if(intval($value) !== 0){
            $arregloNuevo[$key] = intval($value);
        }else{
            $arregloNuevo[$key] = strval($value);
        }
    }

    return $arregloNuevo;
}
?>