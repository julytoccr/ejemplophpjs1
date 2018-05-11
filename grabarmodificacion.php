<?php
    //Comecto a la base de datos
    include("includes/conectarDb.php");
 
    //Ejecuto la consulta de modificacion  
    $mysql->query("update articulos set
                           descripcion='$_REQUEST[descripcion]',
                           precio=$_REQUEST[precio],
                           codigorubro=$_REQUEST[codigorubro]
              where codigo=$_REQUEST[codigo]") or
      die($mysql->error());

    $mysql->close();
 
    //Vuelvo al index.html
    header('Location:/ejemplo1/');
?>
