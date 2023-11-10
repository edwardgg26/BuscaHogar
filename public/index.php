<?php 

    require_once __DIR__."/../includes/app.php";
    use MVC\Router;
    use Controllers\PublicController;
    use Controllers\AdminController;
    use Controllers\PropiedadController;
    use Controllers\VendedorController;
    use Controllers\CiudadController;
    use Controllers\EntradaController;
    use Controllers\LoginController;

    $router = new Router();

    //PUBLICO

    $router->get("./",[PublicController::class,"index"]);
    $router->get("/nosotros",[PublicController::class,"nosotros"]);
    $router->get("/propiedades",[PublicController::class,"propiedades"]);
    $router->post("/propiedades",[PublicController::class,"propiedades"]);
    $router->get("/propiedad",[PublicController::class,"propiedad"]);
    $router->post("/propiedad",[PublicController::class,"propiedad"]);
    $router->get("/blog",[PublicController::class,"blog"]);
    $router->get("/entrada",[PublicController::class,"entrada"]);
    $router->get("/contacto",[PublicController::class,"contacto"]);
    $router->post("/contacto",[PublicController::class,"contacto"]);


    //PRIVADO

    //Panel de administrador
    $router->get("/admin",[AdminController::class,"index"]);

    //Administracion de propiedades
    $router->get("/propiedades/listado",[PropiedadController::class,"listado"]);
    $router->post("/propiedades/listado",[PropiedadController::class,"listado"]);
    $router->get("/propiedades/crear",[PropiedadController::class,"crear"]);
    $router->post("/propiedades/crear",[PropiedadController::class,"crear"]);
    $router->get("/propiedades/actualizar",[PropiedadController::class,"actualizar"]);
    $router->post("/propiedades/actualizar",[PropiedadController::class,"actualizar"]);
    $router->get("/propiedades/borrar",[PropiedadController::class,"borrar"]);
    $router->post("/propiedades/borrar",[PropiedadController::class,"borrar"]);

    //Administracion de vendedores
    $router->get("/vendedores/listado",[VendedorController::class,"listado"]);
    $router->get("/vendedores/crear",[VendedorController::class,"crear"]);
    $router->post("/vendedores/crear",[VendedorController::class,"crear"]);
    $router->get("/vendedores/actualizar",[VendedorController::class,"actualizar"]);
    $router->post("/vendedores/actualizar",[VendedorController::class,"actualizar"]);
    $router->get("/vendedores/borrar",[VendedorController::class,"borrar"]);
    $router->post("/vendedores/borrar",[VendedorController::class,"borrar"]);

    //Administracion de Ciudades
    $router->get("/ciudades/listado",[CiudadController::class,"listado"]);
    $router->get("/ciudades/crear",[CiudadController::class,"crear"]);
    $router->post("/ciudades/crear",[CiudadController::class,"crear"]);
    $router->get("/ciudades/actualizar",[CiudadController::class,"actualizar"]);
    $router->post("/ciudades/actualizar",[CiudadController::class,"actualizar"]);

    //Administracion de Entradas de Blog
    $router->get("/entradas/listado",[EntradaController::class,"listado"]);
    $router->get("/entradas/crear",[EntradaController::class,"crear"]);
    $router->post("/entradas/crear",[EntradaController::class,"crear"]);
    $router->get("/entradas/actualizar",[EntradaController::class,"actualizar"]);
    $router->post("/entradas/actualizar",[EntradaController::class,"actualizar"]);
    $router->get("/entradas/borrar",[EntradaController::class,"borrar"]);
    $router->post("/entradas/borrar",[EntradaController::class,"borrar"]);

    //Login y autenticacion
    $router->get("/login",[LoginController::class,"login"]);
    $router->post("/login",[LoginController::class,"login"]);
    $router->get("/logout",[LoginController::class,"logout"]);

    $router->comprobarRutas();
?>