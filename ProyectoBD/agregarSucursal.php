<?php
require 'includes/config/database.php';
require 'includes/funciones.php';

//Conexion a la BD
$db = conectarDB();

// Arreglo con los errores
$errores = [];

// Variables de los campos
$domicilio = '';
$telefono = '';

// Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

        //Insertar en la BD
        $query = "INSERT INTO sucursal (Domicilio, Telefono) VALUES ('$domicilio', $telefono);";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo '<script type="text/javascript">
                    alert("Sucursal Agregada Correctamente");
                    window.location.href="principal.php";
                </script>';
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

        <h1>Agregar una Sucursal</h1>

        <?php foreach ($errores as $error) :  ?>
            <div class="text-center alert error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="agregarSucursal.php" enctype="multipart/form-data">
            <fieldset>
                <legend> Información sobre la Sucursal</legend>

                <label for="domicilio">Domicilio</label>
                <input type="text" placeholder="Domicilio de la Sucursal" id="domicilio" name="domicilio" required>

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Teléfono de la Sucursal" id="telefono" name="telefono" required>

            </fieldset>

            <input type="submit" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>