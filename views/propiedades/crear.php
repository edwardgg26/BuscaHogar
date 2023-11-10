<main class="contenedor-formulario container">
    <h1>Crear Propiedad</h1>
    <a class="boton-secundario" href="listado">Volver</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if($propiedad->validarAtributos() !== ""){
            echo "<p class='aviso aviso-error'>".$propiedad->validarAtributos()."</p>";
        }elseif(validarImagen($imagenesPropiedad) !== ""){
            echo "<p class='aviso aviso-error'>".validarImagen($imagenesPropiedad)."</p>";
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