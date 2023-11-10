<div class="campo">
    <label for="">Titulo <span class="obligatorio">*</span></label>
    <input type="text" name="titulo" placeholder="Titulo de la propiedad..." value="<?php echo sanitizar($propiedad->titulo) ?>">
</div>
<div class="campo">
    <label for="">Precio <span class="obligatorio">*</span></label>
    <input min="0" step="0.01" type="number" name="precio" placeholder="Precio de la propiedad..." value="<?php echo sanitizar($propiedad->precio) ?>">
</div>

<div class="campo">
    <label for="">Ciudad <span class="obligatorio">*</span></label>
    <select name="ciudad_id">
        <option value="null">Seleccione una Ciudad...</option>
        <?php foreach($ciudades as $ciudad):?>
            <option <?php echo ($ciudad->id === $propiedad->ciudad_id) ? "selected" : ""; ?> value="<?php echo $ciudad->id; ?>">
                <?php echo $ciudad->nombre; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="campo">
    <label for="">Vendedor <span class="obligatorio">*</span></label>
    <select name="vendedor_cedula">
        <option value="null">Seleccione un Vendedor...</option>
        <?php foreach($vendedores as $vendedor):?>
            <option <?php echo ($vendedor->cedula === $propiedad->vendedor_cedula) ? "selected" : ""; ?>
                value="<?php echo $vendedor->cedula; ?>">
                <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="campo">
    <label for="">Agregar Imagenes<span class="obligatorio">*</span></label>
    <input type="file" name="imagenesPropiedad[]" accept="image/jpeg, image/png" multiple>
</div>
<div class="campo">
    <label for="">Area (m²) <span class="obligatorio">*</span></label>
    <input min="1" max="99999" step="0.01" name="area" type="number" placeholder="Area de la propiedad..."
        value="<?php echo sanitizar($propiedad->area) ?>">
</div>
<div class="campo">
    <label for="">Estrato <span class="obligatorio">*</span></label>
    <input min="1" max="6" name="estrato" type="number" placeholder="Estrato de la propiedad..."
        value="<?php echo sanitizar($propiedad->estrato) ?>">
</div>
<div class="campo">
    <label for="">Habitaciones <span class="obligatorio">*</span></label>
    <input min="1" max="20" name="habitaciones" type="number" placeholder="Numero de Habitaciones..."
        value="<?php echo sanitizar($propiedad->habitaciones) ?>">
</div>
<div class="campo">
    <label for="">Baños <span class="obligatorio">*</span></label>
    <input min="1" max="20" name="wc" type="number" placeholder="Numero de Baños..." value="<?php echo sanitizar($propiedad->wc) ?>">
</div>
<div class="campo">
    <label for="">Garajes <span class="obligatorio">*</span></label>
    <input min="1" max="20" name="garajes" type="number" placeholder="Numero de Garajes..."
        value="<?php echo sanitizar($propiedad->garajes) ?>">
</div>