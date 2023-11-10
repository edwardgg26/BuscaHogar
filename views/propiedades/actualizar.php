<main class="contenedor-formulario container">
    <h1>Actualizar Propiedad</h1>
    <a class="boton-secundario" href="listado">Volver</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if ($propiedad->validarAtributos() !== "") {
            echo "<p class='aviso aviso-error'>" . $propiedad->validarAtributos() . "</p>";
        } elseif ($imagenesPropiedad["name"][0] !== "" && validarImagen($imagenesPropiedad) !== "") {
            echo "<p class='aviso aviso-error'>" . validarImagen($imagenesPropiedad) . "</p>";
        }elseif ($error!==""){
            echo "<p class='aviso aviso-error'>" . $error . "</p>";
        }
    }
    ?>

    <form class="formulario formulario--2col formulario--admin" method="POST" enctype="multipart/form-data">
        <?php
        require "formulario.php";
        ?>

        <input type="submit" value="Actualizar" class="boton-primario">

        <?php if (!empty($imagenes)): ?>
            <h3>Imagenes de la Propiedad</h3>
            <div class="contenedorTabla">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Imagén</th>
                            <th>Nombre</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($imagenes as $imagen): ?>
                            <tr>
                                <td class="imagenProp"><img loading="lazy" width="200" height="300"
                                        src="/imagenes/propiedadesimg/<?php echo $imagen->nombre ?>"
                                        alt="Imagén De Propiedad <?php echo $imagen->propiedad_id ?>"> </td>
                                <td>
                                    <?php echo $imagen->nombre ?>
                                </td>
                                <td>
                                    <input type="checkbox" name="imagenAEliminar[]" value="<?php echo $imagen->id ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </form>


</main>