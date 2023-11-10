<main class="container">
    <h1>Crear Entrada</h1>
    <a class="boton-secundario" href="listado">Volver</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($entrada->validarAtributos() !== "") {
            echo "<p class='aviso aviso-error'>".$entrada->validarAtributos()."</p>";
        }elseif(validarImagen($imagenEntrada) !== ""){
            echo "<p class='aviso aviso-error'>".validarImagen($imagenEntrada)."</p>";
        }
    }
    ?>

    <form class="formulario formulario--2col formulario--admin" method="POST" action="crear"
        enctype="multipart/form-data">
        
        <?php
            require "formulario.php";
        ?>

        <input type="submit" value="Crear" class="boton-primario">
    </form>
</main>