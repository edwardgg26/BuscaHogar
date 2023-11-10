<main class="listado container">
    <h1>Listado de Ciudades</h1>
    
    <div class="contenedor-botones">
        <a class="boton-secundario" href="../admin">Volver</a>
        <a href="crear" class="boton-primario"><ion-icon name="add-circle-outline"></ion-icon> Crear Ciudad</a>
    </div>

    <?php
        if (intval($resultado) === 1) {
            echo "<p class='aviso aviso-mensaje'>Ciudad Regristrada Correctamente</p>";
        }elseif(intval($resultado) === 2){
            echo "<p class='aviso aviso-mensaje'>Ciudad Actualizada Correctamente</p>";
        }elseif(intval($resultado) === 3){
            echo "<p class='aviso aviso-mensaje'>Ciudad Eliminada Correctamente</p>";
        }
    ?>

    <div class="contenedorTabla">
        <table class="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($ciudades as $ciudad):?>
                <tr>
                    <td><?php echo $ciudad->id?></td>
                    <td><?php echo $ciudad->nombre?></td>
                    <td><a href="actualizar?id=<?php echo $ciudad->id?>" class="editar"><ion-icon name="create"></ion-icon></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>