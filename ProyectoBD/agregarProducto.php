<?php
require 'includes/config/database.php';
require 'includes/funciones.php';

//Conexion a la BD
$db = conectarDB();

// Obtener las sucursales
$query = "SELECT IdSucursal ,Domicilio FROM sucursal;";
$resultadoConsultaSucursales = mysqli_query($db, $query);

// Obtener los proveedores
$query = "SELECT IdProveedor ,NombreProveedor FROM proveedor;";
$resultadoConsultaProveedores = mysqli_query($db, $query);

// Arreglo con los errores
$errores = [];

// Variables de los campos
$nombre = '';
$marca = '';
$precioVenta = '';
$sucursal = '';
$stock = '';
$precioCompra = '';
$proveedor = '';

// Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    // Llenar las variables con los valores
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $marca = mysqli_real_escape_string($db, $_POST['marca']);
    $precioVenta = mysqli_real_escape_string($db, $_POST['precioVenta']);
    $sucursal = mysqli_real_escape_string($db, $_POST['sucursales']);
    $stock = mysqli_real_escape_string($db, $_POST['stock']);
    $precioCompra = mysqli_real_escape_string($db, $_POST['precioCompra']);
    $proveedor = mysqli_real_escape_string($db, $_POST['provedores']);
    $fechaCompra = date('Y/m/d');


    if (!$nombre) {
        $errores[] = "Falta nombre";
    }

    if (!$marca) {
        $errores[] = "Falta marca";
    }

    if (!$precioVenta) {
        $errores[] = "Falta precio de venta";
    }

    if (!$sucursal) {
        $errores[] = "Falta sucursal";
    }

    if (!$stock) {
        $errores[] = "Falta stock";
    }

    if (!$precioCompra) {
        $errores[] = "Falta precioCompra";
    }

    if (!$proveedor) {
        $errores[] = "Falta proveedor";
    }

    // Revisar que todos los campos esten completos
    if (empty($errores)) {

        //Insertar en la BD
        $query = "";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: principal.php?resultado=1');
        }
    }
}

// Incluye el template
incluirTemplate('header');

?>

<body>
    <header>
        <div class="regresar">
            <a href="principal.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
            </a>
        </div>
    </header>

    <main class="contenido-centrado mt mb">

        <h1>Agregar un Producto al Inventario</h1>

        <?php foreach ($errores as $error) :  ?>
            <div class="text-center alert error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="agregarProducto.php" enctype="multipart/form-data">
            <fieldset>
                <legend> Información sobre el Producto</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Nombre del producto" id="nombre" name="nombre" required>

                <label for="marca">Marca</label>
                <input type="text" placeholder="Marca del producto" id="marca" name="marca" required>

                <label for="precioVenta">Precio de Venta</label>
                <input type="number" placeholder="Precio del producto" id="precioVenta" name="precioVenta" min="0" required>

            </fieldset>

            <fieldset>
                <legend>Sucursal donde Ingresaran</legend>

                <label for="sucursales">Sucursal:</label>
                <select id="sucursales" name="sucursales" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while ($sucursal = mysqli_fetch_assoc($resultadoConsultaSucursales)) : ?>
                        <option value="<?php echo $sucursal['IdSucursal']; ?>"><?php echo $sucursal['Domicilio']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="stock">Stock:</label>
                <input type="number" placeholder="Cantidad del producto" id="stock" name="stock" min="1" required>

                <label for="precioCompra">Precio de Compra</label>
                <input type="number" placeholder="Precio de compra del producto por unidad" id="precioCompra" name="precioCompra" min="1" required>

                <label for="provedores">Proveedor:</label>
                <select id="provedores" name="provedores" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while ($proveedor = mysqli_fetch_assoc($resultadoConsultaProveedores)) : ?>
                        <option value="<?php echo $proveedor['IdProveedor']; ?>"><?php echo $proveedor['NombreProveedor']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>


            <input type="submit" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>