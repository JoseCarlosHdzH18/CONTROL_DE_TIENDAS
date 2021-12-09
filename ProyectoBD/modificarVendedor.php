<?php
require 'includes/funciones.php';
require 'includes/config/database.php';
$db = conectarDB();

if (strcmp($_POST['boton'], "Guardar") == 0) {

    // Llenar las variables con los valores
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);
    $direccion = mysqli_real_escape_string($db, $_POST['direccion']);

    if (!$nombre) {
        $errores[] = "Falta nombre";
    }

    if (!$telefono) {
        $errores[] = "Falta teléfono";
    }
    if (!$direccion) {
        $errores[] = "Falta direccion";
    }

    // Revisar que todos los campos esten completos
    if (empty($errores)) {

        //Actualizar en la BD
        $query = "UPDATE vendedor SET Nombre = '" . $_POST['nombre'] . "', Telefono = " . $_POST['telefono'] . ", Direccion = '" . $_POST['direccion'] . "' WHERE (IdVendedor = '" . $_POST['ID'] . "');";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo '<script type="text/javascript">
                    alert("Vendedor Modificado Correctamente");
                    window.location.href="principal.php";
                </script>';
        }
    }
}

$query = "SELECT * FROM vendedor WHERE IdVendedor=" . $_POST['ID'] . ";";
$resultado = mysqli_query($db, $query);
$vendedor = mysqli_fetch_row($resultado);

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

        <h1>Modificar un Vendedor</h1>

        <form class="formulario" method="POST">
            <fieldset>
                <legend> Información sobre el Vendedor</legend>

                <?php echo "<input type='hidden' name='ID' value='$vendedor[0]'>" ?>

                <label for="nombre">Nombre</label>
                <?php echo "<input type='text' placeholder='Nombre del vendedor' name='nombre' value='$vendedor[1]' required>" ?>

                <label for="telefono">Teléfono</label>
                <?php echo "<input type='text' placeholder='Teléfono del vendedor' name='telefono' value='$vendedor[2]' required>" ?>

                <label for="direccion">Direccion</label>
                <?php echo "<input type='text' placeholder='Dirección del vendedor' name='direccion' value='$vendedor[3]' required>" ?>


            </fieldset>

            <input type="submit" name="boton" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>