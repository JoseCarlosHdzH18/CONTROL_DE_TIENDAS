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
$precios = $_POST['precios'];
$idsucursal = mysqli_real_escape_string($db, $_POST['sucursal']);
$idproveedor = mysqli_real_escape_string($db, $_POST['proveedor']);

if(strcmp($_POST['boton'], "Finalizar") === 0) {

    // Llenar las variables con los valores
    $fecha = date("Y-m-d", time());
    $total = mysqli_real_escape_string($db, $_POST['total']);

    //Insertar compra en la BD
    $query = "INSERT INTO compra (TotalCompra, Fecha, IdProveedor, IdSucursal) VALUES ('$total', '$fecha', '$idproveedor', '$idsucursal');";
    $resultado = mysqli_query($db, $query);

    //Buscar IdCompra
    $query = "SELECT IdCompra FROM compra;";
    $resultado = mysqli_query($db, $query);
    while ($compra = mysqli_fetch_assoc($resultado)){
        $idcompra = $compra['IdCompra'];
    }
    //Insertar en compras por producto y sumar stock
    for($i = 0; $i < count($idproductos); $i++){
        $query = "INSERT INTO productocomprado (IdCompra, Cantidad, PrecioComprado, IdProducto) VALUES ('$idcompra','$cantidades[$i]', '$precios[$i]','$idproductos[$i]')";
        $resultado = mysqli_query($db, $query);
        $query1 = "SELECT * FROM existencia WHERE (IdProducto = '$idproductos[$i]' AND IdSucursal = '$idsucursal');";
        $resultado1 = mysqli_query($db, $query1);
        $existencia = mysqli_fetch_assoc($resultado1);
        if(empty($existencia)){
            $query2 = "INSERT INTO existencia (IdProducto, IdSucursal, Stock) VALUES ('$idproductos[$i]', '$idsucursal', '$cantidades[$i]');";
        }else{
            $cantidades[$i] = (int)$existencia['Stock'] + (int)$cantidades[$i];
            $query2 = "UPDATE existencia SET Stock = '$cantidades[$i]' WHERE (IdProducto = '$idproductos[$i]' AND IdSucursal='$idsucursal');";
        }
        $resultado2 = mysqli_query($db, $query2);
    }
    
    if($resultado && $resultado1 && $resultado2) {
        echo'<script type="text/javascript">
                alert("Compra Registrada Con Éxito");
                window.location.href="principal.php";
            </script>';
    }
}

for ($i = 0; $i < count($idproductos); $i++) {
    $query = "SELECT * FROM producto WHERE IdProducto='".$idproductos[$i]."'";
    $resultado = mysqli_query($db, $query);
    $fila = mysqli_fetch_assoc($resultado);
    $productos[] = $fila['NombreProducto'];
}

$query = "SELECT NombreProveedor FROM proveedor Where (IdProveedor = '".$idproveedor."');";
$resproveedor = mysqli_query($db, $query);
$proveedor = mysqli_fetch_assoc($resproveedor);

$query = "SELECT Domicilio FROM sucursal Where (IdSucursal = '".$idsucursal."');";
$ressucursal = mysqli_query($db, $query);
$sucursal = mysqli_fetch_assoc($ressucursal);

incluirTemplate('header');
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <div class="regresar">
        <a href="tablaProductosC.php">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg>
        </a>
    </div>
    <h1>Información de la Compra</h1>
</header>
<form class="formulario" action="confirmarCompra.php" method="POST">
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
        <label for="proveedor">Proveedor:</label>
        <select id="proveedor" name="proveedor" required>
            <?php echo "<option value='".$idproveedor."'  selected>".$proveedor['NombreProveedor']."</option>"; ?>
        </select>
        <label for="proveedor">Sucursal:</label>
        <select id="sucursal" name="sucursal" required>
            <?php echo "<option value='".$idsucursal."'  selected>".$sucursal['Domicilio']."</option>"; ?>
        </select>
        <input type="submit" class="boton" name="boton" value="Finalizar">
    </div>
</form>
</body>

</html>