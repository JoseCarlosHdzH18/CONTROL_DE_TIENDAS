<?php
require 'includes/config/database.php';
require 'includes/funciones.php';
$total = 0;
$db = conectarDB();
$query = "SELECT * FROM venta;";
    $resultado = mysqli_query($db, $query);
    while ($venta = mysqli_fetch_assoc($resultado)){
        $idventa = $venta['venta'];
    }
    //Insertar en
echo $idventa;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form>
    <?php
      echo date("d/m/Y", time());
     ?>
  </form>
</body>
</html>