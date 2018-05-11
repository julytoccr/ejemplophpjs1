/****************************************************
 * Esto se ejecuta cuando se termina de cargar el DOM
 */
$( document ).ready(function() {


   var mensaje_de_carga_inicial="...Cargando lista de productos inicial...";

  /*
   * Designo el handler(la funcion buscarProducto()) del evento "click" 
   * del boton Buscar
   */
  $("#boton_buscar").on('click',buscarProducto);


  //Muestro el mensaje de carga inicial
  $("#lista_de_productos").html(mensaje_de_carga_inicial);

  //Cargo al entrar la lista de productos
  buscarListaDeProductos();


  // Ejecuto cada 2 seg (2000 ms) la funcion que refresca la lista de productos
  setInterval( buscarListaDeProductos ,2000 );

});


/*******************************************************
 * Funcion para buscar la lista de productos al servidor
 * El PHP devuelve HTML en este caso y el JS lo inserta en el div correspondiente
 */
var buscarListaDeProductos = function(){
  //Realizo el GET Ajax hacia el php
  $.get("ws/listaProductosAjax.php",
         function (data) {
             /*
              * Coloco en el div correspondiente el contenido de la lista
              * de productos que me devolvio el php
              */
             $("#lista_de_productos").html(data);
         });  
}



/*************************************************************
 * Funcion que se asocia al evento "click" del boton de Buscar
 * Recibe del webserver un JSON
 */
var buscarProducto = function(){   
     //Tomo el nro de producto a buscar, escrito en el input
     var nro_producto = $("#nro_producto").val();

     //Realizo el GET ajax al Webserver donde le envio el nro de producto a buscar
     $.get("ws/realizaBusquedaAjax.php", {
                 nro_producto: nro_producto
         },

         /*
          * Esta funcion que sigue se ejecuta si se realiza correctamente la consulta 
          * ajax a realizaBusquedaAjax recibiendo en el parametro "data" lo que viene
          *  de ejecutar el ajax sobre el archivo php, en este caso es un JSON 
          */ 
         function (data) {
             //Tomo el Json que me devuelve el Php en la consulta Ajax, que viene en el parametro "data"
             // de esta funcion anonima
             var datos_recibidos = jQuery.parseJSON(data);
             
             //Armo lo que tengo que poner en el elemento contenedor de la respuesta Ajax con la funcion armaRespuestaDeBusqueda()
             respuesta_para_el_browser=armaRespuestaDeBusqueda(datos_recibidos);

             //Modifico el contenido html del div contenedor
             $("#respuesta_de_busqueda").html(respuesta_para_el_browser);

         })
}


/**************************************************************************************
 * Funcion que se encarga de armar el HTML que se va a mostrar con el JSON que se obtiene 
 * de hacer una busqueda de producto
 */
var armaRespuestaDeBusqueda = function(datos){

             //Armo lo que tengo que poner en el elemento contenedor de la busqueda
             //con la respuesta Ajax que devolvio el Php en el servidor que viene en el parametro "datos"
             return "<br/> Descripcion : "+datos.descripcion + "<br/> Precio : "+datos.precio;
}
