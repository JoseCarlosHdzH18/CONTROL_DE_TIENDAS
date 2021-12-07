<?php 
require 'includes/funciones.php';
require 'includes/config/database.php';
$db = conectarDB();

if($_SERVER['REQUEST_METHOD'] === 'POST' && strcmp($_POST['boton'], "Guardar") == 0) {

    // Llenar las variables con los valores
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($db, $_POST['telefono']);

    if(!$nombre){
        $errores[] = "Falta nombre";
    }

    if(!$telefono){
        $errores[] = "Falta teléfono";
    }

    // Revisar que todos los campos esten completos
    if(empty($errores)) {

        //Insertar en la BD
        $query = "UPDATE clientes SET NombreCliente = '".$_POST['nombre']."', Telefono = '".$_POST['telefono']."' WHERE (IdClientes = '".$_POST['ID']."');";

        $resultado = mysqli_query($db, $query);
        
        if($resultado) {
            echo'<script type="text/javascript">
                    alert("Cliente Modificado Correctamente");
                    window.location.href="principal.php";
                </script>';
        }
    }
}

$query = "SELECT * FROM CLIENTES WHERE IdClientes=".$_POST['ID'].";";
$resultado = mysqli_query($db, $query);
$cliente = mysqli_fetch_row($resultado);

// Incluye el template
incluirTemplate('header');

?>

<body>
    <header>
        <div class="regresar">
            <a href="tablaClientes.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
              </svg>
            </a>
        </div>
    </header>

    <main class="contenido-centrado mt mb">

        <h1>Modificar un Cliente</h1>

        <form class="formulario" method="POST">
            <fieldset>
                <legend> Información sobre el Cliente</legend>
                <?php echo "<input type='hidden' name='ID' value='".$cliente[0]."'>"?>
                <label for="nombre">Nombre</label>
                <?php echo "<input placeholder='Nombre Completo' type='text' name='nombre' value='".$cliente[1]."' required>" ?>

                <label for="telefono">Teléfono</label>
                <?php echo "<input type='tel' placeholder='Teléfono del Cliente' name='telefono' value='".$cliente[2]."' required>" ?>

            </fieldset>

            <input type="submit" name="boton" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>