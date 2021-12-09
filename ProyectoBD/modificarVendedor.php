<?php 
require 'includes/config/database.php';
require 'includes/funciones.php';

$db = conectarDB();

$errores = [];

$nombre = '';
$telefono  ='';
$domicilio = '';
$puesto = '';
$contrasena = '';
$contrasenaConf = '';

if(strcmp($_POST['boton'], "Guardar") === 0){
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $telefono  = mysqli_real_escape_string($db, $_POST['telefono']);
    $domicilio = mysqli_real_escape_string($db, $_POST['domicilio']);
    $puesto = mysqli_real_escape_string($db, $_POST['puesto']);
    $contrasena = mysqli_real_escape_string($db, $_POST['password']);
    $contrasenaConf = mysqli_real_escape_string($db, $_POST['passwordConf']);

    if(!$nombre){
        $errores[] = "Falta nombre";
    }

    if(!$telefono){
        $errores[] = "Falta telefono";
    }

    if(!$domicilio){
        $errores[] = "Falta domicilio";
    }

    if(!$puesto){
        $errores[] = "Falta puesto";
    }

    if(!$contrasena){
        $errores[] = "Falta contraseña";
    }

    if(!$contrasenaConf){
        $errores[] = "Falta confirmar la contraseña";
    }

    if($contrasena !== $contrasenaConf){
        $errores[] = "Las constraseñas no coinciden";
    }
    

    if(empty($errores)){
        // hassear password
        $passwordHash = password_hash($contrasena, PASSWORD_DEFAULT);

        echo "<p>$passwordHash<p>";
        $query = "UPDATE vendedor SET Nombre = '".$nombre."', Telefono = ".$telefono.", Direccion = '".$domicilio."', Puesto = '".$puesto."', Contrasena = '".$passwordHash."' WHERE (IdVendedor='".$_POST['ID']."');";

        $resultado = mysqli_query($db, $query);

        if($resultado){
            echo'<script type="text/javascript">
                    alert("Vendedor Modificado Correctamente");
                    window.location.href="principal.php";
                </script>';
        } 
    }
}

    $query = "SELECT * FROM vendedor WHERE (IdVendedor = '".$_POST['ID']."');";
    $resultado = mysqli_query($db, $query);
    if(!$resultado){
        echo "<script>alert('No se pudo cargar la Información')
              window.location.href='principal.php'</script>";
    }
    $vendedor = mysqli_fetch_row($resultado);
    // Incluye el template
    incluirTemplate('header');
?>

<body>
    <header>
        <div class="regresar">
            <a href="tablaVendedor.php">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
              </svg>
            </a>
        </div>
    </header>

    <main class="contenido-centrado mt mb">

        <h1>Modificar un Empleado</h1>

        <form class="formulario" method="POST">
            <fieldset>
                <legend> Información sobre el Empleado</legend>
                <?php echo "<input type='hidden' name='ID' value='".$_POST['ID']."'>" ?>
                <label for="nombre">Nombre</label>
                <?php echo "<input type='text' value='$vendedor[1]' placeholder='Nombre Completo del Empleado' id='nombre' name='nombre' required>" ?>

                <label for="telefono">Teléfono</label>
                <?php echo "<input type='tel' placeholder='Teléfono del Empleado' id='telefono' name='telefono' value='$vendedor[2]' required>" ?>

                <label for="domicilio">Domicilio</label>
                <?php echo "<input type='text' placeholder='Domicilio del Empleado' id='domicilio' name='domicilio' value='$vendedor[3]' required>" ?>

                <label for="puesto">Puesto</label>
                <select id="puesto" name="puesto" required>
                    <option disabled>-- Seleccione --</option>
                    <?php
                        echo "<option value='vendedor'";
                        if (strcmp($vendedor[4], "vendedor") === 0)
                            echo " selected";
                        echo ">Vendedor</option>";
                        echo "<option value='administrador'";
                        if (strcmp($vendedor[4], "administrador") === 0)
                            echo " selected";
                        echo ">Administrador</option>";
                    ?>
                    <!--<option value="vendedor">Vendedor</option>
                    <option value="administrador">Administrador</option>-->
                </select>

                <label for="password">Contraseña</label>
                <input type="password" placeholder="Este Campo lo Tiene que Llenar el Empleado" id="password" name="password" required>

                <label for="password">Confirmar Contraseña</label>
                <input type="password" placeholder="Ingresar Nuevamente la Contraseña" id="password" name="passwordConf" required>

            </fieldset>

            <input type="submit" id="boton" name="boton" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>