<?php
require 'includes/config/database.php';
require 'includes/funciones.php';
$db = conectarDB();



$query = "SELECT * FROM productocomprado;";
$resultado = mysqli_query($db, $query);

$query2 = "SELECT * FROM venta;";
$resultado2 = mysqli_query($db, $query2);

$query1 = "SELECT * FROM compra;";
$resultado1 = mysqli_query($db, $query1);

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
        <h1 class="boton-azulClaro ">Historial</h1>
        <div>
            <table>
                <caption>PRODUCTOS COMPRADOS</caption>
                <tr>
                    <td>ID Compra</td>
                    <td>Fecha</td>
                    <td>Total</td>
                    <td></td>

                </tr>
                <?php
                while ($datos = $resultado1->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $datos["IdCompra"] ?></td>
                        <td><?php echo $datos["Fecha"] ?></td>
                        <td>$<?php echo $datos["TotalCompra"] ?></td>
                        <?php echo "
                        <td>
                                <form action='tablaHistorialComprados.php' method='POST'>
                                    <input type='hidden' name='ID' value='$datos[0]'>
                                    <input type='submit' name='boton' value='Desplegar' class='btn-modificar'>
                                </form>
                        </td>
                        ";?>
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
                    <td>ID Venta</td>
                    <td>Fecha</td>
                    <td>Total</td>
                    <td></td>

                </tr>
                <?php
                if (empty($resultado2)) {
                ?>
                    <td>No hay registros</td>
                    <?php
                } else {
                    while ($datos = $resultado2->fetch_array()) {
                    echo "
                        <tr>
                            <td> $datos[0]</td>
                            <td> $datos[2]</td>
                            <td>$$datos[1]</td>
                            <td>
                                <form action='tablaHistorial.php' method='POST'>
                                    <input type='hidden' name='ID' value='$datos[0]'>
                                    <input type='submit' name='boton' value='Desplegar' class='btn-modificar'>
                                </form>
                            </td>
                        </tr>
                        ";
                    }
                }
                ?>
            </table>
        </div>


    </main>
</body>