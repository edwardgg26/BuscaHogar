<div class="campo">
    <label for="">Titulo</label>
    <input type="text" name="titulo" placeholder="Titulo de la propiedad...">
</div>
<div class="campo">
    <label for="">Precio Minimo</label>
    <input min="0" step="0.01" type="number" name="precio_minimo" placeholder="Precio minimo de la propiedad...">
</div>
<div class="campo">
    <label for="">Precio Maximo</label>
    <input min="0" step="0.01" type="number" name="precio_maximo" placeholder="Precio maximo de la propiedad...">
</div>

<div class="campo">
    <label for="">Ciudad</label>
    <select name="ciudad_id">
        <option value="null">Seleccione una Ciudad...</option>
        <?php foreach ($ciudades as $ciudad): ?>
            <option value="<?php echo $ciudad->id; ?>">
                <?php echo $ciudad->nombre; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


<?php if($_SERVER["PATH_INFO"] === "/propiedades/listado"): ?>
<div class="campo">
    <label for="">Vendedor</label>
    <select name="vendedor_cedula">
        <option value="null">Seleccione un Vendedor...</option>
        <?php foreach ($vendedores as $vendedor): ?>
            <option value="<?php echo $vendedor->cedula; ?>">
                <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<?php endif;?>

<div class="campo">
    <label for="">Area minima (m²)</label>
    <input min="0" step="0.01" type="number" name="area_minimo" placeholder="Area Minima de la propiedad...">
</div>

<div class="campo">
    <label for="">Area maxima (m²)</label>
    <input min="0" step="0.01" type="number" name="area_maximo" placeholder="Area Maxima de la propiedad...">
</div>

<div class="campo">
    <label for="">Estrato</label>
    <select name="estrato">
        <option value="null">Seleccione un Estrato...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
    </select>
</div>

<div class="campo">
    <label for="">Habitaciones</label>
    <input min="0" type="number" name="habitaciones" placeholder="Habitaciones de la propiedad...">
</div>

<div class="campo">
    <label for="">Baños</label>
    <input min="0" type="number" name="wc" placeholder="Baños de la propiedad...">
</div>

<div class="campo">
    <label for="">Garajes</label>
    <input min="0" type="number" name="garaje" placeholder="Garajes de la propiedad...">
</div>