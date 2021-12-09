<?php
    require 'includes/config/database.php';
    require 'includes/funciones.php';
    $db = conectarDB();

    $query = "Select * FROM producto NATURAL JOIN existencia WHERE (existencia.IdSucursal = '".$_POST['sucursales']."')";
    $resultado = mysqli_query($db, $query);
    if($resultado === false){
        echo ("No se encontró");
    }

    incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="en">
    <header>
        <div class="regresar">
            <a href="seleccionarSucursal.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
              </svg>
            </a>
        </div>
        <h1>Seleccione los productos a vender</h1>
    </header>
    <body>
        
        <div class="tabla contenido-centrado mt mb">
        <form action="confirmarVenta.php" method="POST">
        <table>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Producto</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Proveedor</th>
                <th>Existencia</th>
                <th>Cantidad</th>
            </tr>
            <?php
                while(($fila = mysqli_fetch_assoc($resultado)) == true){
                    echo "
                        <tr>
                        <td><input type='checkbox' id='".$fila['IdProducto']."' name='productos[]' value='".$fila['IdProducto']."'></td>
                        <td>".$fila['IdProducto']."</td>
                        <td>".$fila['NombreProducto']."</td>
                        <td>".$fila['MarcaProducto']."</td>
                        <td>".$fila['Precio']."</td>
                        <td>".$fila['IdProveedor']."</td>
                        <td>".$fila['Stock']."</td>
                        <script>
                            document.getElementById('".$fila['IdProducto']."').onchange = function() {
                                document.getElementById('".$fila['IdProducto']."s').disabled = !this.checked;
                                if(document.getElementById('".$fila['IdProducto']."s').disabled){
                                    document.getElementById('".$fila['IdProducto']."s').value = '0';
                                }else{
                                    document.getElementById('".$fila['IdProducto']."s').value = '1';
                                }
                                if(parseInt('".$fila['Stock']."',10) === 0){
                                    document.getElementById('".$fila['IdProducto']."s').value = '0';
                                    document.getElementById('".$fila['IdProducto']."s').disabled = true;
                                    document.getElementById('".$fila['IdProducto']."').checked = false;
                                }
                            };
                        </script>
                        <td><input type='number' id='".$fila['IdProducto']."s' name='cantidades[]' value='0' disabled></td>
                        <script>
                            document.getElementById('".$fila['IdProducto']."s').onchange = function() {
                                
                                if (parseInt(document.getElementById('".$fila['IdProducto']."s').value, 10) < 1){
                                    document.getElementById('".$fila['IdProducto']."s').value = '1';
                                }
                                if (parseInt(document.getElementById('".$fila['IdProducto']."s').value, 10) > parseInt('".$fila['Stock']."',10)){
                                    document.getElementById('".$fila['IdProducto']."s').value = '".$fila['Stock']."';
                                }
                            };
                        </script>
                        </tr>";
                        
                }
                echo "<input type='hidden' name='sucursales' value='".$_POST['sucursales']."'>";
            ?>
        </table>
        <input type="submit" class="boton" name="boton" value="Pasar a Pagar">  
        </form> 
        </div>
    </body>
</html>