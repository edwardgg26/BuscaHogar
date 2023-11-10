<main class="contenedor-formulario container">
    <h1>Actualizar Vendedor</h1>
    <a class="boton-secundario" href="listado">Volver</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($vendedor->validarAtributos() !== "") {
            echo "<p class='aviso aviso-error'>" . $vendedor->validarAtributos() . "</p>";
        }
    }
    ?>

    <form class="formulario formulario--2col formulario--admin" method="POST" enctype="multipart/form-data">
        <?php
        require "formulario.php";
        ?>

        <input type="submit" value="Actualizar" class="boton-primario">
    </form>


</main>