<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION["login"]??false;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuscaHogar</title>

    <!--Fuentes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!--Estilos-->

    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo isset($inicio) ? 'inicio' : ' ';?>">
        <div class="container contenido-header">
            <div class="barra">

                <a class="logo" href="/">Busca<span class="logo--bold">Hogar</span></a>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 6l16 0" />
                    <path d="M4 12l16 0" />
                    <path d="M4 18l16 0" />
                </svg>
                <nav class="navegacion navegacion--header">

                    <?php if(!$auth): ?>
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                    <?php endif;?>

                    <?php if($auth): ?>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/admin">Admin</a>
                        <a href="/logout">Cerrar</a>
                    <?php endif;?>

                </nav>

            </div>
            
            <?php if(isset($inicio)){?>
                <h1 class="heading-header">Venta de Casas y Departamentos<br>Exclusivos de Lujo</h1>
            <?php }?>
        </div>
    </header>

    <div>
    <?php
        echo $contenido;
    ?>
    </div>


    <footer class="footer">
        <div class="container barra--footer">
            <div class="barra">
                <a class="logo" href="/">Busca<span class="logo--bold">Hogar</span></a>

                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Propiedades</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>

            <p>Todos los derechos reservados <?php echo date("Y"); ?> &copy;</p>
        </div>
    </footer>
    
    
    <script src="/build/js/bundle.min.js"></script>

    <!--Ionic Icons-->
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
</body>

</html>