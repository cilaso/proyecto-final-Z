/*Para enlaces de menú con ruta relativa y sin parámetros:*/
$(document).ready(function () {
    url_completa = location.href; //URL de la pagina actual
    url_incio = url_completa.lastIndexOf("/");
    pagina_actual = url_completa.slice(url_incio + 1); //Extraemos el nombre de la pagina
    // Asignamos la clase llamada "activo" 
    $("#menu li a[href='" + pagina_actual + "']").parent().addClass("activo");
});


