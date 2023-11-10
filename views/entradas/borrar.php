<main class="contenedor-formulario container">
    <h1>Borrar Propiedad</h1>

    <p>La siguiente entrada de blog se eliminará de forma PERMANENTE <?php echo ($entrada->imagen!=="") ? "junto a su imagen" : ""?>, ¿Estás Seguro/a de eliminarla?</p>
    <p>Entrada No. <?php echo $entrada->id?>, Titulo: "<?php echo $entrada->titulo?>", Fecha: "<?php echo $entrada->fecha?>"</p>
    <form class="formulario formulario--flex-column" method="POST" enctype="multipart/form-data">
        <input type="submit" value="Borrar" class="boton-eliminar">
        <a class="boton-secundario" href="listado">Cancelar</a>
    </form>
    <p>Contenido: <?php echo $entrada->contenido?></p>
    <?php if($entrada->imagen !== ""): ?>
        <img loading="lazy" width="200" height="300" src="/imagenes/entradasimg/<?php echo $entrada->imagen?>" alt="Imagen de entrada <?php echo $entrada->id?>">
    <?php endif;?>
</main>