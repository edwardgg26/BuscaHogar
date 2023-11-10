<div class="campo">
    <label for="">Cedula <span class="obligatorio">*</span></label>
    <input type="number" name="cedula" placeholder="Cedula del vendedor..." value="<?php echo sanitizar($vendedor->cedula) ?>">
</div>
<div class="campo">
    <label for="">Nombre <span class="obligatorio">*</span></label>
    <input type="text" name="nombre" placeholder="Nombre del vendedor..." value="<?php echo sanitizar($vendedor->nombre) ?>">
</div>
<div class="campo">
    <label for="">Apellido <span class="obligatorio">*</span></label>
    <input type="text" name="apellido" placeholder="Apellido del vendedor..." value="<?php echo sanitizar($vendedor->apellido) ?>">
</div>
<div class="campo">
    <label for="">Telefono <span class="obligatorio">*</span></label>
    <input type="number" name="telefono" placeholder="Telefono del vendedor..." value="<?php echo sanitizar($vendedor->telefono) ?>">
</div>
<div class="campo">
    <label for="">Correo <span class="obligatorio">*</span></label>
    <input type="email" name="correo" placeholder="Correo del vendedor..." value="<?php echo sanitizar($vendedor->correo) ?>">
</div>