<?php
    //Conecto a la base de datos
    include("includes/conectarDb.php");
 
    //Ejecuto la consulta de borrado
    $mysql->query("delete from articulos where codigo=$_GET[codigo]") or
        die($mysql->error);
    $mysql->close();

    //Vuelvo al index.html
    header('Location:/ejemplo1/');
?>
