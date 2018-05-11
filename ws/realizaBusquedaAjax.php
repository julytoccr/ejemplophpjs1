<?php
/*****************************************************************************
 * Se encarga de buscar un producto y devolver un json con los datos del mismo
 * si lo encuentra, sino envia un JSON con el error
 */

    //incluyo e instancio la conexion con el servidor Mysql
    //esto me crea el objeto $mysql
    include("../includes/conectarDb.php");

    //Armo la consulta
    $consulta_sql="select descripcion,precio from articulos where codigo=".$_GET['nro_producto'];

    //Ejecuto la query en el servidor
    $registros=$mysql->query($consulta_sql) or die($mysql->error);

    //Obtengo la respuesta del Mysql
    $reg=$registros->fetch_array(MYSQLI_ASSOC);

    //Se encontro el articulo?
    if ($reg)
        //Si encuentra algo, genero el json a enviar como respuesta al JS que hizo la consulta
        $resultado=json_encode($reg);
    else
        //Si no encuentro mando este json por defecto indicando que no encontro nada
        $resultado="{\"descripcion\": \"NO ENCONTRADO!!\",\"precio\": \"0\"}";

    //cierro conexion con el servidor Mysql
    $mysql->close();

    //Envio el json armado al JS que me hizo la consulta
    echo $resultado;
?>
