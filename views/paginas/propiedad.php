<main class="propiedad container">
    <a class="boton-secundario" href="/propiedades">Volver</a>

    <div class="galeriaPropiedad">

        <button class="galeriaPropiedad__left"><</button>
        <button class="galeriaPropiedad__right">></button>
        <?php foreach ($imagenes as $imagen): ?>
            <img class="galeriaPropiedad__imagen" loading="lazy" width="200" height="300" src="/imagenes/propiedadesimg/<?php echo $imagen->nombre; ?>"
                alt="Imagén De Anuncio <?php echo $propiedad->id; ?>">
        <?php endforeach; ?>
    </div>

    <div class="caracteristicasYContacto">
        <div class="caracteristicasPropiedad">
            <h3>
                <?php echo $propiedad->titulo; ?>
            </h3>
            <p>Vendedor:
                <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?>
            </p>
            <p>
                <?php echo $ciudad->nombre; ?>
            </p>
            <p>Precio: $
                <?php echo number_format($propiedad->precio, 2); ?>
            </p>
            <p>Area:
                <?php echo number_format($propiedad->area, 2); ?> m²
            </p>
            <p>Estrato:
                <?php echo $propiedad->estrato; ?>
            </p>
            <div class="caractHabitaciones">
                <div class="iconoHab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bed" width="80"
                        height="80" viewBox="0 0 24 24" stroke-width="1.5" stroke="#323232" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />
                        <path d="M7 10m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
                    <p>Habitaciones:
                        <?php echo $propiedad->habitaciones; ?>
                    </p>
                </div>
                <div class="iconoHab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-car" width="80"
                        height="80" viewBox="0 0 24 24" stroke-width="1.5" stroke="#323232" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
                    </svg>
                    <p>Garajes:
                        <?php echo $propiedad->garajes; ?>
                    </p>
                </div>
                <div class="iconoHab">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bath" width="80"
                        height="80" viewBox="0 0 24 24" stroke-width="1.5" stroke="#323232" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4v-3a1 1 0 0 1 1 -1z" />
                        <path d="M6 12v-7a2 2 0 0 1 2 -2h3v2.25" />
                        <path d="M4 21l1 -1.5" />
                        <path d="M20 21l-1 -1.5" />
                    </svg>
                    <p>Baños:
                        <?php echo $propiedad->wc; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="contactoPropiedad">
            <a class="boton-secundario" href="#contacto">Enviar Correo</a>

            <?php if ($vendedor->telefono != null || !empty($vendedor->telefono)): ?>
                <a class="boton-secundario" href="https://wa.me/57<?php echo $vendedor->telefono; ?>"
                    target="_blank">WhatsApp</a>
            <?php endif; ?>
        </div>
    </div>
</main>
<section class="contacto">
    <form id="contacto" class="formulario formulario--2col formulario--contacto" action="/propiedad?id=<?php echo $propiedad->id; ?>" method="POST">

        <h3>Contacta a <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></h3>

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
            <input type="number" name="telefono" placeholder="Ej. 321456285">
        </div>
        <div class="campo">
            <label for="">Correo</label>
            <input type="email" name="correo" placeholder="Ej. micorreo@gmail.com">
        </div>
        <div class="campo">
            <label for="">Mensaje</label>
            <textarea name="mensaje" rows="10">¡Hola!, me interesa la propiedad "<?php echo $propiedad->titulo?>" situada en la ciudad <?php echo $ciudad->nombre?>.</textarea>
        </div>

        <input class="boton-secundario" type="submit" value="Enviar">
    </form>
</section>