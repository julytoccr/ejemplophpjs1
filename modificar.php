<!doctype html>
<html>
<head>
  <title>Modificacion de articulo.</title>
</head>
<body>
<?php
    //Conectar a la base de datos
    include("includes/conectarDb.php");  

    //Consulto datos del producto a buscar 
    $registro=$mysql->query("select descripcion,precio,codigorubro from articulos where codigo=$_GET[codigo]") or
      die($mysql->error);

    //Si encontro lo muestro
    if ($reg=$registro->fetch_array()){
?>
       <form method="post" action="grabarmodificacion.php">
       Descripcion del articulo:
       <input type="text" name="descripcion" size="50" value="<?php echo $reg['descripcion']; ?>"><br>
       Precio
       <input type="text" name="precio" size="10" value="<?php echo $reg['precio']; ?>"><br>
       Rubro:
       <select name="codigorubro">
<?php
       //Consulto los rubro para armar el select de rubros
       $registros2=$mysql->query("select codigo,descripcion from rubros") or
         die($mysql->error);

       //Armo el select dependiendo al rubro actual
       while ($reg2=$registros2->fetch_array()){
         if ($reg2['codigo']==$reg['codigorubro'])
            echo "<option value=\"".$reg2['codigo']."\" selected>".$reg2['descripcion']."</option>";
          else 
            echo "<option value=\"".$reg2['codigo']."\">".$reg2['descripcion']."</option>";
       }
       ?>

       </select>
       <input type="hidden" name="codigo" value="<?php echo $_REQUEST['codigo']; ?>">
       <br>
       <input type="submit" value="Confirmar">
       </form>
<?php
    }
    else
	  echo 'No existe un articulo con dicho codigo';
    $mysql->close();
?>
</body>
</html>
