<?php
require 'includes/config/database.php';
require 'includes/funciones.php';
$db = conectarDB();



$query = "SELECT * FROM productocomprado;";
$resultado = mysqli_query($db, $query);

$query2 = "SELECT * FROM productovendido;";
$resultado2 = mysqli_query($db, $query2);

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
        <h1 class="boton-azulClaro " >Historial</h1>
        <div>
            <table>
                <caption >PRODUCTOS COMPRADOS</caption>
                <tr>
                    <td>ID Compra</td>
                    <td>Cantidad</td>
                    <td>Precio</td>
                    <td>ID Producto</td>

                </tr>
                <?php
                while ($datos = $resultado->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $datos["IdCompra"] ?></td>
                        <td><?php echo $datos["Cantidad"] ?></td>
                        <td><?php echo $datos["PrecioComprado"] ?></td>
                        <td><?php echo $datos["IdProducto"] ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div>
            <table>
                <caption>PRODUCTOS VENDIDOS</caption>
                <tr>
                    <td>ID Compra</td>
                    <td>Cantidad</td>
                    <td>Precio</td>
                    <td>ID Producto</td>

                </tr>
                <?php
                if (empty($resultado2)) {
                ?>
                    <td>No hay registros</td>
                    <?php
                } else {
                    while ($datos = $resultado2->fetch_array()) {
                    ?>
                        <tr>
                            <td><?php echo $datos["IdProducto"] ?></td>
                            <td><?php echo $datos["Cantidad"] ?></td>
                            <td><?php echo $datos["PrecioVendido"] ?></td>
                            <td><?php echo $datos["IdVenta"] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>


    </main>
</body>