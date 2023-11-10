<div class="prop container">
    <h3>Propiedades en Venta</h3>

    <div class="contenedor-filtros">

        <button class="boton-primario boton-filtros">Filtros</button>

        <form class="formulario formulario--3col formulario--filtros" method="POST" action="propiedades">
            <?php 
                require "../views/propiedades/filtro_propiedad.php";
            ?>

            <input type="submit" value="Filtrar" class="boton-primario">
        </form>
    </div>
    
    <main class="propiedades-sec">

        <div class="tarjetas-depto">
            <?php 
                require "tarjeta_propiedad.php";
            ?>
        </div>
    </main>
</div>