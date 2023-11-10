<main class="container">
    <h1>Actualizar Ciudad</h1>
    <a class="boton-secundario" href="listado">Volver</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($ciudad->validarAtributos() !== "") {
            echo "<p class='aviso aviso-error'>" . $ciudad->validarAtributos() . "</p>";
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