<main class="contacto">
    <form class="formulario formulario--2col formulario--contacto" action="/contacto" method="POST">

        <h3>Contactanos</h3>

        <?php

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if(isset($errorValidacion) && $errorValidacion !== ""){
                echo "<p class='aviso aviso-error'>".$errorValidacion."</p>";
            }
        }

        if (isset($respuesta)){
            if( intval($respuesta) === 1) {
                echo "<p class='aviso-mensaje'>Mensaje Enviado Correctamente</p>";
            }elseif(intval($resultado) === 0){
                echo "<p class='aviso-error'>Error al enviar el mensaje</p>";
            }
        }
        ?>

        <div class="campo">
            <label for="">Nombre y Apellido</label>
            <input type="text" name="nombreyapellido" placeholder="Ej. Carlos">
        </div>
        <div class="campo">
            <label for="">Telefono</label>
            <input type="tel" name="telefono" placeholder="Ej. 321456285">
        </div>
        <div class="campo">
            <label for="">Correo</label>
            <input type="email" name="correo" placeholder="Ej. micorreo@gmail.com">
        </div>
        <div class="campo">
            <label for="">Mensaje</label>
            <textarea name="mensaje" rows="10"> </textarea>
        </div>

        <input class="boton-secundario" type="submit" value="Enviar">
    </form>
</main>