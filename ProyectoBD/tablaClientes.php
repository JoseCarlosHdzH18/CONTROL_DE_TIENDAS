<?php
require 'includes/config/database.php';
require 'includes/funciones.php';
$db = conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && strcmp($_POST['boton'], "Eliminar") == 0) {
    $query = "DELETE FROM clientes WHERE (IdClientes = " . $_POST['ID'] . ");";
    mysqli_query($db, $query);
}
$query = "Select * FROM clientes";
$resultado = mysqli_query($db, $query);

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
    <h1>Clientes</h1>
</header>

<body>
    <div class="tabla">
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th colspan="2">Acción</th>
            </tr>

            <?php
            while (($fila = mysqli_fetch_row($resultado)) == true) {
                echo "<tr>
                        <td>$fila[0]</td>
                        <td>$fila[1]</td>
                        <td>$fila[2]</td>
                        <td>
                            <form action='modificarClientes.php' method='POST'>
                            <input type='hidden' name='ID' value='$fila[0]'>
                            <input type='submit' name='boton' value='Modificar'>
                            </form>
                        </td>
                        <td>
                            <form action='tablaClientes.php' method='POST'>
                            <input type='hidden' name='ID' value='$fila[0]'>
                            <input type='submit' name='boton' value='Eliminar'>
                            </form>
                        </td>
                        </tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>