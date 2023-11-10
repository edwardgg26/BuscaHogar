<?php 

use Model\Imagen;
use Model\Ciudad;

foreach($propiedades as $propiedad):?> 
<div class="tarjeta-depto">
    <?php 
        $imagen = Imagen::consultaPorPropiedad($propiedad->id);
        $ciudad = Ciudad::consultaPorId($propiedad->ciudad_id);
    ?>
    <img class="tarjeta-depto__imagen" loading="lazy" width="200" height="300" src="/imagenes/propiedadesimg/<?php echo $imagen[0]->nombre;?>" alt="Imagén De Anuncio <?php echo $propiedad->id;?>">
    <p class="tarjeta-depto__titulo"><?php echo $propiedad->titulo ;?> </p>
    <p class="tarjeta-depto__ciudad"><?php echo $ciudad->nombre;?></p>
    <p class="tarjeta-depto__precio">$<?php echo number_format( $propiedad->precio,2) ;?> COP</p>
    <p class="tarjeta-depto__area">Area: <?php echo $propiedad->area;?> m²</p>

    <div class="habitaciones">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bed" width="80" height="80"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="#323232" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />
                <path d="M7 10m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
            </svg>
            <p><?php echo $propiedad->habitaciones;?></p>
        </div>

        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-car" width="80" height="80"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="#323232" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                <path d="M5 17h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
            </svg>
            <p><?php echo $propiedad->garajes;?></p>
        </div>

        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bath" width="80" height="80"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="#323232" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 12h16a1 1 0 0 1 1 1v3a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4v-3a1 1 0 0 1 1 -1z" />
                <path d="M6 12v-7a2 2 0 0 1 2 -2h3v2.25" />
                <path d="M4 21l1 -1.5" />
                <path d="M20 21l-1 -1.5" />
            </svg>
            <p><?php echo $propiedad->wc;?></p>
        </div>
    </div>
    <a class="boton-secundario" href="propiedad?id=<?php echo $propiedad->id;?>">Ver Propiedad</a>
</div>
<?php endforeach;?>