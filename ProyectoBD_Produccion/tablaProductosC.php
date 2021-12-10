<?php
require 'includes/config/database.php';
require 'includes/funciones.php';
$db = conectarDB();

$query = "Select * FROM proveedor;";
$resProveedor = mysqli_query($db, $query);
if ($resProveedor === false) {
    echo "<script> alert('No se encontraron proveedores');
        window.location.href='principal.php';
        </script>";
}

$query = "Select * FROM sucursal;";
$resSucursal = mysqli_query($db, $query);
if ($resSucursal === false) {
    echo "<script> alert('No se encontraron sucursales');
        window.location.href='principal.php';
        </script>";
}

$query = "Select * FROM producto;";
$resultado = mysqli_query($db, $query);
if ($resultado === false) {
    echo "<script> alert('No se encontraron productos');
        window.location.href='principal.php';
        </script>";
}

incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <div class="regresar">
        <a href="principal.php">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
        </a>
    </div>
    <h1>Seleccione los productos a comprar</h1>
</header>

<body>

    <div class="tabla contenido-centrado mt mb">
        <form action="confirmarCompra.php" method="POST">
            <div class="formulario">
                <label for="proveedor">Proveedor:</label>
                <select id="proveedor" name="proveedor" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while ($proveedor = mysqli_fetch_assoc($resProveedor)) : ?>
                        <option value="<?php echo $proveedor['IdProveedor']; ?>"><?php echo $proveedor['NombreProveedor']; ?></option>
                    <?php endwhile; ?>
                </select>
                <label for="sucursal">Sucursal:</label>
                <select id="sucursal" name="sucursal" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while ($sucursal = mysqli_fetch_assoc($resSucursal)) :
                        echo "<option value='".$sucursal['IdSucursal']."'>".$sucursal['Domicilio']."</option>";
                    endwhile; ?>
                </select>
            </div>
            <table>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Precio Compra</th>
                    <th>Cantidad</th>
                </tr>
                <?php
                while (($fila = mysqli_fetch_assoc($resultado)) == true) {
                    echo "
                        <tr>
                        <td><input type='checkbox' id='".$fila['IdProducto']."' name='productos[]' value='".$fila['IdProducto']."'></td>
                        <script>
                        </script>
                        <td>".$fila['NombreProducto']."</td>
                        <td>".$fila['MarcaProducto']."</td>
                        <td><input type='number' id='".$fila['IdProducto']."p' name='precios[]' value='0' disabled></td>
                        <td><input type='number' id='".$fila['IdProducto']."s' name='cantidades[]' value='0' disabled></td>

                        
                        <script>
                            document.getElementById('".$fila['IdProducto']."').onchange = function() {
                                document.getElementById('".$fila['IdProducto']."p').disabled = !this.checked;

                                if(document.getElementById('".$fila['IdProducto']."p').disabled){
                                    document.getElementById('".$fila['IdProducto']."p').value = '0';
                                }else{
                                    document.getElementById('".$fila['IdProducto']."p').value = '0';
                                }

                                document.getElementById('".$fila['IdProducto']."s').disabled = !this.checked;
                                if(document.getElementById('".$fila['IdProducto']."s').disabled){
                                    document.getElementById('".$fila['IdProducto']."s').value = '0';
                                }else{
                                    document.getElementById('".$fila['IdProducto']."s').value = '1';
                                }
                            };

                            document.getElementById('".$fila['IdProducto']."p').onchange = function() {
                                if (parseInt(document.getElementById('".$fila['IdProducto']."p').value, 10) < 0){
                                    document.getElementById('".$fila['IdProducto']."p').value = '0';
                                }
                            };

                            document.getElementById('".$fila['IdProducto']."s').onchange = function() {
                                if (parseInt(document.getElementById('".$fila['IdProducto']."s').value, 10) < 1){
                                    document.getElementById('".$fila['IdProducto']."s').value = '1';
                                }
                            };
                        </script>
                        </tr>";
                }
                ?>
            </table>
            <input type="submit" class="boton" name="boton" value="Pasar a Confirmación">
        </form>
    </div>
</body>

</html>