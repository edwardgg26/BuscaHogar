"use strict";

document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
});

function eventListeners(){
    const botonMenu = document.querySelector(".icon-tabler-menu-2");
    botonMenu.addEventListener("click",mostrarMenuNavegacion);

    try{
        const botonFiltros = document.querySelector(".boton-filtros");
        botonFiltros.addEventListener("click",()=>{
            const formularioFiltros = document.querySelector(".formulario--filtros");
            formularioFiltros.classList.toggle("mostrar-filtros");
        });
    }catch(error){

    }
    //Galeria
    try {
        iniciarGaleria();
    } catch (error) {
    }
}

//Menu Navegacion Mobile
function mostrarMenuNavegacion(){
    const menuNav = document.querySelector(".navegacion--header");
    menuNav.classList.toggle("desplegarNavegacion");
}

function iniciarGaleria(){

    const imagenes = document.querySelectorAll(".galeriaPropiedad__imagen");
    const mapImagenes = imagenes;
    imagenes.forEach(imagen => {
        imagen.remove();
    });

    let contador = 0;
    const primeraImagen = mapImagenes[0];
    const nombreImagen = primeraImagen.getAttribute("alt");
    const contenedor = document.querySelector(".galeriaPropiedad");

    const imagen = document.createElement("img");
    imagen.setAttribute("loading","lazy");
    imagen.setAttribute("alt",nombreImagen);
    imagen.setAttribute("class","galeriaPropiedad__imagen");
    imagen.setAttribute("width","200");
    imagen.setAttribute("height","300");
    imagen.setAttribute("src",primeraImagen.getAttribute("src"));
    imagen.setAttribute("name","imagenPropiedad");
    
    contenedor.appendChild(imagen);
    const botonIzquierda = document.querySelector(".galeriaPropiedad__left");
    const botonDerecha = document.querySelector(".galeriaPropiedad__right");

    botonIzquierda.addEventListener("click",()=>{
        if(contador > 0){
            imagen.setAttribute("src",imagenes[--contador].getAttribute("src"));
        }
    });

    botonDerecha.addEventListener("click",()=>{
        if(contador < mapImagenes.length-1){
            imagen.setAttribute("src",imagenes[++contador].getAttribute("src"));
        }
    });
}