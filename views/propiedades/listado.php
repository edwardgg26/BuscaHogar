<?php
    use Model\Ciudad;
    use Model\Vendedor;
?>

<main class="listado container">
    <h1>Listado de Propiedades</h1>
    
    <div class="contenedor-botones">
        <a class="boton-secundario" href="../admin">Volver</a>
        <a href="crear" class="boton-primario"><ion-icon name="add-circle-outline"></ion-icon> Crear Propiedad</a>
    </div>

    <div class="contenedor-filtros">

        <button class="boton-primario boton-filtros">Filtros</button>
        <form class="formulario formulario--3col formulario--admin formulario--filtros" method="POST" action="listado">
            <?php 
                require "filtro_propiedad.php";
            ?>

            <input type="submit" value="Filtrar" class="boton-primario">
        </form>
    </div>

    <?php
        if (intval($resultado) === 1) {
            echo "<p class='aviso aviso-mensaje'>Propiedad Regristrada Correctamente</p>";
        }elseif(intval($resultado) === 2){
            echo "<p class='aviso aviso-mensaje'>Propiedad Actualizada Correctamente</p>";
        }elseif(intval($resultado) === 3){
            echo "<p class='aviso aviso-mensaje'>Propiedad Eliminada Correctamente</p>";
        }
    ?>

    <div class="contenedorTabla">
        <table class="tabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Precio</th>
                    <th>Ciudad</th>
                    <th>Vendedor</th>
                    <th>Area m²</th>
                    <th>Estrato</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                    <th>Garajes</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($propiedades as $propiedad):?>
                <tr>
                    <?php
                        $ciudad = Ciudad::consultaPorId($propiedad->ciudad_id);
                        $vendedor = Vendedor::consultaPorId($propiedad->vendedor_cedula);
                    ?>
                    <td><?php echo $propiedad->id?></td>
                    <td><?php echo $propiedad->titulo?></td>
                    <td><?php echo "$".number_format($propiedad->precio, 2)." COP"?></td>
                    <td><?php echo $ciudad->nombre?></td>
                    <td><?php echo $vendedor->nombre." ".$vendedor->apellido?></td>
                    <td><?php echo $propiedad->area?></td>
                    <td><?php echo $propiedad->estrato?></td>
                    <td><?php echo $propiedad->habitaciones?></td>
                    <td><?php echo $propiedad->wc?></td>
                    <td><?php echo $propiedad->garajes?></td>
                    <td><a href="actualizar?id=<?php echo $propiedad->id?>" class="editar"><ion-icon name="create"></ion-icon></a></td>
                    <td><a href="borrar?id=<?php echo $propiedad->id?>" class="eliminar"><ion-icon name="trash"></ion-icon></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>