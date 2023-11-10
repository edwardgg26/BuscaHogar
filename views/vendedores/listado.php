<main class="listado container">
    <h1>Listado de Vendedores</h1>
    
    <div class="contenedor-botones">
        <a class="boton-secundario" href="../admin">Volver</a>
        <a href="crear" class="boton-primario"><ion-icon name="add-circle-outline"></ion-icon> Crear Vendedor</a>
    </div>

    <?php
        if (intval($resultado) === 1) {
            echo "<p class='aviso aviso-mensaje'>Vendedor Regristrado Correctamente</p>";
        }elseif(intval($resultado) === 2){
            echo "<p class='aviso aviso-mensaje'>Vendedor Actualizado Correctamente</p>";
        }elseif(intval($resultado) === 3){
            echo "<p class='aviso aviso-mensaje'>Vendedor Eliminado Correctamente</p>";
        }
    ?>

    <div class="contenedorTabla">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($vendedores as $vendedor):?>
                <tr>
                    <td><?php echo $vendedor->cedula?></td>
                    <td><?php echo $vendedor->nombre?></td>
                    <td><?php echo $vendedor->apellido?></td>
                    <td><?php echo $vendedor->telefono?></td>
                    <td><?php echo $vendedor->correo?></td>
                    <td><a href="actualizar?id=<?php echo $vendedor->cedula?>" class="editar"><ion-icon name="create"></ion-icon></a></td>
                    <td><a href="borrar?id=<?php echo $vendedor->cedula?>" class="eliminar"><ion-icon name="trash"></ion-icon></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>