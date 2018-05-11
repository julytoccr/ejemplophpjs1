<?php
    //Conecto a la base de datos
    include("includes/conectarDb.php");

    //Ejecuta la consulta de insertar
    $mysql->query("insert into articulos(descripcion,precio,codigorubro)
        values ('$_REQUEST[descripcion]',$_REQUEST[precio],$_REQUEST[codigorubro])") or
      die($mysql->error);
    $mysql->close();

    //Vuelvo al index.html
    header('Location:/ejemplo1/');
?>
