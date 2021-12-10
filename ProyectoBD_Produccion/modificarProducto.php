<?php 
require 'includes/config/database.php';
require 'includes/funciones.php';

$db = conectarDB();

if(strcmp($_POST['boton'], "Guardar") == 0) {

    // Llenar las variables con los valores
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $marca = mysqli_real_escape_string($db, $_POST['marca']);
    $precioVenta = mysqli_real_escape_string($db, $_POST['precio']);

    if(!$nombre){
        $errores[] = "Falta nombre";
    }

    if(!$marca){
        $errores[] = "Falta marca";
    }

    if(!$precioVenta){
        $errores[] = "Falta precio de venta";
    }

    // Revisar que todos los campos esten completos
    if(empty($errores)) {

        //Actualizar en la BD
        $query = "UPDATE producto SET NombreProducto = '$nombre', MarcaProducto = '$marca', Precio = $precioVenta WHERE (IdProducto = '".$_POST['ID']."');";

        $resultado = mysqli_query($db, $query);
        
        if($resultado) {
            echo'<script type="text/javascript">
                    alert("Producto Modificado Correctamente");
                    window.location.href="tablaProducto.php";
                </script>';
        }
    }
}

$query = "SELECT * FROM producto WHERE IdProducto=".$_POST['ID'].";";
$resultado = mysqli_query($db, $query);
$producto = mysqli_fetch_row($resultado);

// Incluye el template
incluirTemplate('header');

?>

<body>
    <header>
        <div class="regresar">
            <a href="tablaProducto.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
              </svg>
            </a>
        </div>
    </header>

    <main class="contenido-centrado mt mb">

        <h1>Modificar un Producto del Inventario</h1>

        <form class="formulario" method="POST">
            <fieldset>
                <legend> Información sobre el Producto</legend>

                <?php echo "<input type='hidden' name='ID' value='$producto[0]'>" ?>

                <label for="nombre">Nombre</label>
                <?php echo "<input type='text' placeholder='Nombre del producto' id='nombre' name='nombre' value='$producto[1]' required>" ?>

                <label for="marca">Marca</label>
                <?php echo "<input type='text' placeholder='Marca del producto' id='marca' name='marca' value='$producto[2]' required>" ?>

                <label for="precio">Precio de Venta</label>
                <?php echo "<input type='number' placeholder='Precio del producto' id='precio' name='precio' value='$producto[3]' min='0' required>" ?>


            </fieldset>

            <!-- <fieldset>
                <legend>Sucursal donde Ingresaran</legend>

                <label for="stock">Stock:</label>
                <input type="number" placeholder="Cantidad del producto" id="stock" min="1" required>

                <label for="sucursales">Sucursal:</label>
                <select id="sucursales" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="sucursal X">Sucursal X</option>
                    <option value="Sucursal Y">Sucursal Y</option>
                </select>

                <label for="stock">Precio de Compra</label>
                <input type="number" placeholder="Precio del producto por unidad" id="stock" min="1" required>
            </fieldset> -->


            <input type="submit" name="boton" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>