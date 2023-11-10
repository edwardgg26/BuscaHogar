<main class="listado container">
    <h1>Listado de Entradas</h1>
    
    <div class="contenedor-botones">
        <a class="boton-secundario" href="../admin">Volver</a>
        <a href="crear" class="boton-primario"><ion-icon name="add-circle-outline"></ion-icon> Crear Entrada</a>
    </div>

    <?php
        if (intval($resultado) === 1) {
            echo "<p class='aviso aviso-mensaje'>Entrada Regristrada Correctamente</p>";
        }elseif(intval($resultado) === 2){
            echo "<p class='aviso aviso-mensaje'>Entrada Actualizada Correctamente</p>";
        }elseif(intval($resultado) === 3){
            echo "<p class='aviso aviso-mensaje'>Entrada Eliminada Correctamente</p>";
        }
    ?>

    <div class="contenedorTabla">
        <table class="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th>Minutos</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($entradas as $entrada):?>
                <tr>
                    <td><?php echo $entrada->id?></td>
                    <td><?php echo $entrada->titulo?></td>
                    <td><?php echo $entrada->fecha?></td>
                    <td><?php echo $entrada->minutos?></td>
                    <td><a href="actualizar?id=<?php echo $entrada->id?>" class="editar"><ion-icon name="create"></ion-icon></a></td>
                    <td><a href="borrar?id=<?php echo $entrada->id?>" class="eliminar"><ion-icon name="trash"></ion-icon></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>