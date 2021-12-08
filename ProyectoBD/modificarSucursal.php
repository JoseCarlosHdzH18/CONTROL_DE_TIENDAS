<?php
require 'includes/funciones.php';
require 'includes/config/database.php';
$db = conectarDB();

if (strcmp($_POST['boton'], "Guardar") == 0) {

    // Llenar las variables con los valores
    $domicilio = mysqli_real_escape_string($db, $_POST['domicilio']);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);

    if (!$domicilio) {
        $errores[] = "Falta domicilio";
    }

    if (!$telefono) {
        $errores[] = "Falta teléfono";
    }
    // Revisar que todos los campos esten completos
    if (empty($errores)) {

        //Actualizar en la BD
        $query = "UPDATE sucursal SET Domicilio = '" . $_POST['domicilio'] . "', Telefono = " . $_POST['telefono'] . " WHERE (IdSucursal = '" . $_POST['ID'] . "');";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo '<script type="text/javascript">
                    alert("Sucursal Modificada Correctamente");
                    window.location.href="principal.php";
                </script>';
        }
    }
}

$query = "SELECT * FROM sucursal WHERE IdSucursal=" . $_POST['ID'] . ";";
$resultado = mysqli_query($db, $query);
$sucursal = mysqli_fetch_row($resultado);

// Incluye el template
incluirTemplate('header');

?>

<body>
    <header>
        <div class="regresar">
            <a href="tablaSucursal.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
            </a>
        </div>
    </header>

    <main class="contenido-centrado mt mb">

        <h1>Modificar una Sucursal</h1>

        <form class="formulario" method="POST">
            <fieldset>
                <legend> Información sobre la Sucursal</legend>

                <?php echo "<input type='hidden' name='ID' value='" . $sucursal[0] . "'>" ?>

                <label for="domicilio">Domicilio</label>
                <?php echo "<input type='text' placeholder='Domicilio de la Sucursal' name='domicilio' value='" . $sucursal[1] . "' required>" ?>

                <label for="telefono">Teléfono</label>
                <?php echo "<input type='tel' placeholder='Teléfono de la Sucursal' name='telefono' value='" . $sucursal[2] . "' required>" ?>

            </fieldset>

            <input type="submit" name="boton" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>