<?php 
require 'includes/funciones.php';
require 'includes/config/database.php';
$db = conectarDB();

$query = "Select * FROM CLIENTES WHERE IdClientes=".$_POST['ID'].";";
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

        <form class="formulario">
            <fieldset>
                <legend> Información sobre el Cliente</legend>
                <?php echo "<input type='Hidden' name='ID' value='".$_POST['ID']."'>"?>
                <label for="nombre">Nombre</label>
                <?php echo "<input placeholder='Nombre Completo' type='text' id='nombre' value='".$cliente[1]."' required>" ?>

                <label for="telefono">Teléfono</label>
                <?php echo "<input type='tel' placeholder='Teléfono del Cliente' id='telefono' value='".$cliente[2]."' required>" ?>

            </fieldset>

            <input type="submit" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>