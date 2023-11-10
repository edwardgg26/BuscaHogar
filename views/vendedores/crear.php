<main class="contenedor-formulario container">
    <h1>Crear Vendedor</h1>
    <a class="boton-secundario" href="listado">Volver</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if($vendedor->validarAtributos() !== ""){
            echo "<p class='aviso aviso-error'>".$vendedor->validarAtributos()."</p>";
        }
    }
    ?>

    <form class="formulario formulario--admin" method="POST" action="crear"
        enctype="multipart/form-data">
        
        <?php
            require "formulario.php";
        ?>

        <input type="submit" value="Crear" class="boton-primario">
    </form>
</main>