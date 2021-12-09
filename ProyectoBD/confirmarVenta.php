<?php
require 'includes/config/database.php';
require 'includes/funciones.php';
$total = 0;
$db = conectarDB();

$errores = [];
if (empty($_POST['cantidades']) || empty($_POST['productos'])){
    echo "<script>
        alert('No se selecciónó ningún producto');
        history.back();
    </script>";
}
$cantidades = $_POST['cantidades'];
$idproductos = $_POST['productos'];
$sucursales = mysqli_real_escape_string($db, $_POST['sucursales']);

if(strcmp($_POST['boton'], "Finalizar") === 0) {

    // Llenar las variables con los valores
    $fecha = date("Y-m-d", time());
    $idvendedor = mysqli_real_escape_String($db, $_POST['vendedor']);
    $idcliente = mysqli_real_escape_String($db, $_POST['cliente']);
    $total = mysqli_real_escape_string($db, $_POST['total']);
    $precios = $_POST['precios'];

    //Insertar venta en la BD
    $query = "INSERT INTO venta (TotalVenta, Fecha, IdVendedor, IdCliente) VALUES ('$total', '$fecha', '$idvendedor', '$idcliente');";
    $resultado = mysqli_query($db, $query);

    $query = "SELECT IdVenta FROM venta;";
    $resultado = mysqli_query($db, $query);
    while ($venta = mysqli_fetch_assoc($resultado)){
        $idventa = $venta['IdVenta'];
    }
    //Insertar en Ventas por producto y restar stock
    for($i = 0; $i < count($idproductos); $i++){
        $query = "INSERT INTO productovendido (IdProducto, Cantidad, PrecioVendido, IdVenta) VALUES ('$idproductos[$i]','$cantidades[$i]', '$precios[$i]','$idventa')";
        $resultado = mysqli_query($db, $query);
        $query1 = "SELECT * FROM existencia WHERE (IdProducto = '$idproductos[$i]' AND IdSucursal = '$sucursales');";
        $resultado1 = mysqli_query($db, $query1);
        $existencia = mysqli_fetch_assoc($resultado1);
        $cantidades[$i] = (int)$existencia['Stock'] - (int)$cantidades[$i];
        $query2 = "UPDATE existencia SET Stock = '$cantidades[$i]' WHERE (IdProducto = '$idproductos[$i]' AND IdSucursal='$sucursales');";
        $resultado2 = mysqli_query($db, $query2);
    }
    
    if($resultado && $resultado1 && $resultado2) {
        echo'<script type="text/javascript">
                alert("Venta Realizada Con Éxito");
                window.location.href="principal.php";
            </script>';
    }
}

for ($i = 0; $i < count($idproductos); $i++) {
    $query = "SELECT * FROM producto WHERE IdProducto='".$idproductos[$i]."'";
    $resultado = mysqli_query($db, $query);
    $fila = mysqli_fetch_assoc($resultado);
    $productos[] = $fila['NombreProducto'];
    $precios[] = $fila['Precio'];
}
$query = "SELECT * FROM clientes";
$resclientes = mysqli_query($db, $query);
$query = "SELECT * FROM vendedor";
$resvendedores = mysqli_query($db, $query);

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
    <h1>Información de la Venta</h1>
</header>
<form class="formulario" action="confirmarVenta.php" method="POST">
    <div class="tabla contenido-centrado">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>

            <?php
            $total = 0;
            for ($i = 0; $i < count($idproductos); $i++) {
                $subtotal[] = (int)$cantidades[$i] * (int)$precios[$i];
                $total = $total + $subtotal[$i];
                echo "<tr>
                    <td>" . $idproductos[$i] . "</td>
                    <td>" . $productos[$i] . "</td>
                    <td>" . $cantidades[$i] . "</td>
                    <td>" . $precios[$i] . "</td>
                    <td>" . $subtotal[$i] . "</td>
                    </tr>
                    <input type='hidden' name='productos[]' value='" . $idproductos[$i] . "'>
                    <input type='hidden' name='precios[]' value='" . $precios[$i] . "'>
                    <input type='hidden' name='cantidades[]' value='" . $cantidades[$i] . "'>";
            }
            echo "
                <input type='hidden' name='sucursales' value='" . $_POST['sucursales'] . "'>
                <input type='hidden' name='total' value='$total'>";
            ?>
            <tr>
                <td><b>Total</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b><?php echo $total;?></b></td>
            </tr>
        </table>
        <label for="vendedor">Vendedor:</label>
        <select id="vendedor" name="vendedor" required>
            <option value="" disabled selected>-- Seleccione --</option>
            <?php while ($vendedor = mysqli_fetch_assoc($resvendedores)) : ?>
                <option value="<?php echo $vendedor['IdVendedor']; ?>"><?php echo $vendedor['Nombre']; ?></option>
            <?php endwhile; ?>
        </select>
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" required>
            <option value="" disabled selected>-- Seleccione --</option>
            <?php while ($cliente = mysqli_fetch_assoc($resclientes)) :
                echo "<option value='".$cliente['IdClientes']."'>".$cliente['NombreCliente']."</option>";
             endwhile; ?>
        </select>
        <input type="submit" class="boton" name="boton" value="Finalizar">
    </div>
</form>
</body>

</html>