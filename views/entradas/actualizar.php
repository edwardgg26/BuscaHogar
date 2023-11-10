<main class="container">
    <h1>Actualizar Entrada</h1>
    <a class="boton-secundario" href="listado">Volver</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if($entrada->validarAtributos() !== ""){
            echo "<p class='aviso aviso-error'>".$entrada->validarAtributos()."</p>";
        }elseif($errorImagen && validarImagen($imagenEntrada) !== ""){
            echo "<p class='aviso aviso-error'>".validarImagen($imagenEntrada)."</p>";
        }
    }
    ?>

    <form class="formulario formulario--2col formulario--admin" method="POST" enctype="multipart/form-data">
        <?php
        require "formulario.php";
        ?>

        <input type="submit" value="Actualizar" class="boton-primario">

        <?php if ($entrada->imagen !== ""): ?>
            <h3>Imagen de la Entrada</h3>
            <img loading="lazy" width="200" height="300" src="/imagenes/entradasimg/<?php echo $entrada->imagen?>" alt="Imagen de entrada <?php echo $entrada->id?>">
        <?php endif; ?>
    </form>
</main>