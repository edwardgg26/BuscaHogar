<main class="propiedades-sec propiedades-sec--main container">
    <h3>
        <?php echo $entrada->titulo ?>
    </h3>
    <img class="imagenEntrada" loading="lazy" width="200" height="300"
        src="/imagenes/entradasimg/<?php echo $entrada->imagen ?>"
        alt="Imagen de Entrada <?php echo $entrada->id ?>">

    <p>Fecha:
        <?php echo $entrada->fecha ?>
    </p>
    <p>Lectura de
        <?php echo $entrada->minutos ?> minutos
    </p>
    <div class="contenidoEntrada">
        <p>
            <?php echo $entrada->contenido ?>
        </p>
    </div>
</main>