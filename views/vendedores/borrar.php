<main class="contenedor-formulario container">
    <h1>Borrar Vendedor</h1>

    <p>El siguiente vendedor se eliminará de forma PERMANENTE junto a sus propiedades, ¿Estás Seguro/a de eliminarlo?</p>
    <p>Cedula: <?php echo $vendedor->cedula?>, Nombre: "<?php echo $vendedor->nombre." ".$vendedor->apellido?>", Telefono: "<?php echo $vendedor->telefono?>", Correo: "<?php echo $vendedor->correo?>"</p>
    <form class="formulario formulario--flex-column" method="POST" enctype="multipart/form-data">
        <input type="submit" value="Borrar" class="boton-eliminar">
        <a class="boton-secundario" href="listado">Cancelar</a>
    </form>
</main>