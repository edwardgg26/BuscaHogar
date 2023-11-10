<?php 

    function contectarDB() :mysqli{
        $db = new mysqli("localhost","root","","bienesraices_crud");

        if (!$db){
            echo "No se pudo conectar al servidor";
            exit;
        }

        return $db;
    }
?>