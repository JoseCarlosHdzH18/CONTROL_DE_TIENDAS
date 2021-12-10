<?php
    require 'includes/config/database.php';
    require 'includes/funciones.php';
    $db = conectarDB();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && strcmp($_POST['boton'], "Desplegar") == 0){
        $query = "SELECT * FROM productovendido  WHERE (IdVenta = '".$_POST['ID']."');";
        mysqli_query($db, $query);
    }
    $resultado = mysqli_query($db, $query);

    incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="en">
    <header>
        <div class="regresar">
            <a href="verHistorial.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
              </svg>
            </a>
        </div>
        <h1>Productos de la Venta</h1>
    </header>
    <body>
        <div class="tabla contenido-centrado">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
            </tr>
            
            <?php
                while(($fila = mysqli_fetch_row($resultado)) == true){
                    $query2 = "SELECT NombreProducto FROM producto WHERE IdProducto = " . $fila[0].";";
                    $resultado2 = mysqli_query($db, $query2);
                    $nombre = $resultado2->fetch_array()[0] ?? '';
                    $query2 = "SELECT MarcaProducto FROM producto WHERE IdProducto = " . $fila[0].";";
                    $resultado2 = mysqli_query($db, $query2);
                    $marca = $resultado2->fetch_array()[0] ?? '';
                    echo "<tr>
                        <td>$nombre</td>
                        <td>$marca</td>
                        <td>$fila[1]</td>
                        <td>$$fila[2]</td>";
                }
            ?>
        </table>   
        </div>
    </body>
</html>