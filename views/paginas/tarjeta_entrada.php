<?php foreach($entradas as $entrada): ?>
<article class="entrada">
    <?php if($entrada->imagen !== ""): ?>
    <img loading="lazy" width="200" height="300" src="/imagenes/entradasimg/<?php echo $entrada->imagen;?>" alt="Imagen de entrada <?php echo $entrada->id?>"> 
    <?php endif; ?>

    <div class="entrada-contenido">
        <p class="entrada-contenido__titulo"><?php echo $entrada->titulo ?></p>
        <p>Fecha: <?php echo $entrada->fecha ?></p>
        <p>Lectura de <?php echo $entrada->minutos ?> minutos</p>
        <a class="boton-secundario" href="entrada?id=<?php echo $entrada->id?>">Leer Entrada</a>
    </div>
</article>
<?php endforeach;?>