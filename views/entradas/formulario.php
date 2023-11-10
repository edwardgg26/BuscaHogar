<div class="campo">
    <label for="">Titulo <span class="obligatorio">*</span></label>
    <input type="text" name="titulo" placeholder="Titulo de la entrada..." value="<?php echo sanitizar($entrada->titulo) ?>">
</div>
<div class="campo">
    <label for="">Tiempo Lectura (Minutos) <span class="obligatorio">*</span></label>
    <input type="number" name="minutos" placeholder="Tiempo de lectura..." value="<?php echo sanitizar($entrada->minutos) ?>">
</div>
<div class="campo">
    <label for="">Contenido <span class="obligatorio">*</span></label>
    <textarea name="contenido" id="" cols="30" rows="10" placeholder="Contenido de la entrada..."><?php echo sanitizar($entrada->contenido) ?></textarea>
</div>
<div class="campo">
    <label for="">Agregar Imagen</label>
    <input type="file" name="imagenEntrada" accept="image/jpeg, image/png">
</div>