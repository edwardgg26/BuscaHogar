<main class="container centrado-flex">

    <form class="formulario formulario--login" method="POST" enctype="multipart/form-data" action="/login">
        <h3>Iniciar Sesión</h3>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $error !== "") {
            echo "<p class='aviso-error'>".$error."</p>";
        }
        ?>
        <div class="campo">
            <label for="">Correo</label>
            <input type="email" name="correo" placeholder="Ingrese su Correo..." required>
        </div>
        <div class="campo">
            <label for="">Contraseña</label>
            <input min="0" type="password" name="password" placeholder="Ingrese la Contraseña..." required>
        </div>
        <input type="submit" value="Ingresar" class="boton-primario">
    </form>

</main>
