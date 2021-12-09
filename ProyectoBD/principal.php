<?php 
require 'includes/funciones.php';


// Incluye el template
incluirTemplate('header');

?>

<body>

    <main class="contenido-centrado">

        <div class="botones-principales">
            <a href="seleccionarSucursal.php" class="boton-verde boton-principal">Iniciar Venta</a>
            <a href="verHistorial.php" class="boton-azulClaro boton-principal">Historial de Ventas</a>
        </div>

        <div class="botones-secundarios">
            <a href="agregarProducto.php" class="boton">Agregar Producto</a>
            <a href="agregarProveedor.php" class="boton">Agregar Proveedor</a>
            <a href="agregarVendedor.php" class="boton">Agregar Vendedor</a>
            <a href="agregarSucursal.php" class="boton">Agregar Sucursal</a>
            <a href="agregarClientes.php" class="boton">Agregar Cliente</a>
        </div>

        <div class="botones-secundarios">
            <a href="modificarProducto.php" class="boton">Modificar Producto</a>
            <a href="tablaProveedor.php" class="boton">Modificar Proveedor</a>
            <a href="tablaVendedor.php" class="boton">Modificar Vendedor</a>
            <a href="tablaSucursal.php" class="boton">Modificar Sucursal</a>
            <a href="tablaClientes.php" class="boton">Modificar Cliente</a>
        </div>

    </main>

    <script src="js/app.js"></script>
</body>

</html>