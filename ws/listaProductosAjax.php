<?php
/*****************************************************
 * Se encarga de armar la lista de productos a mostrar
 */

    //Conecto al Mysql
    include("../includes/conectarDb.php");

    //Armo la consulta SQL
    $consulta_sql="select ar.codigo as codigoart,ar.descripcion as descripcionart,precio,ru.descripcion as descripcionrub from articulos as ar inner join rubros as ru on ru.codigo=ar.codigorubro order by descripcionart asc";

    //Ejecuto la consulta
    $registros=$mysql->query($consulta_sql) or die($mysql->error);

    echo '<table class="tablalistado">';
    echo "\n<tr><th>Codigo</th><th>Descripcion</th><th>Precio</th><th>Rubro</th><th>Borrar</th><th>Modificar</th></tr>\n\n";

    //Itero sobre lo que me devuelve la base de datos de productos y armo el contenido del table 
    while ($reg=$registros->fetch_array()){
      echo "\n<tr>";
      echo '<td>';
      echo $reg['codigoart'];
      echo '</td>';
      echo '<td>';
      echo $reg['descripcionart'];
      echo '</td>';
      echo '<td>';
      echo $reg['precio'];
      echo '</td>';
      echo '<td>';
      echo $reg['descripcionrub'];
      echo '</td>';
      echo '<td>';
      echo '<a href="baja.php?codigo='.$reg['codigoart'].'">Borra?</a>';
      echo '</td>';
      echo '<td>';
      echo '<a href="modificar.php?codigo='.$reg['codigoart'].'">Modifica?</a>';
      echo '</td>';
      echo '</tr>'; 
    }

    echo '<tr><td colspan="6">';
    echo '<a href="alta.php">Agrega un nuevo articulo?</a>';
    echo '</td></tr>';
    echo "\n\n</table>";

    //cierro la conexion a la base de datos
    $mysql->close();

?>
