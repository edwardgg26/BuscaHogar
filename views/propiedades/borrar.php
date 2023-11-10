<main class="contenedor-formulario container">
    <h1>Borrar Propiedad</h1>

    <p>La siguiente propiedad se eliminará de forma PERMANENTE junto a sus imagenes, ¿Estás Seguro/a de eliminarla?</p>
    <p>Propiedad No. <?php echo $propiedad->id?>, Titulo: "<?php echo $propiedad->titulo?>", Vendedor: "<?php echo $vendedor->nombre." ".$vendedor->apellido?>", Ciudad: "<?php echo $ciudad->nombre?>"</p>
    <form class="formulario formulario--flex-column" method="POST" enctype="multipart/form-data">
        <input type="submit" value="Borrar" class="boton-eliminar">
        <a class="boton-secundario" href="listado">Cancelar</a>
    </form>
    <div class="contenedor-imagenes">
        <?php foreach ($imagenes as $imagen): ?>
            <img loading="lazy" width="200" height="300" src="/imagenes/propiedadesimg/<?php echo $imagen->nombre?>" alt="Imagén De Propiedad <?php echo $propiedad->id?>">
        <?php endforeach;?>
    </div>
</main>