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

if($_SERVER['REQUEST_METHOD'] === 'POST'){
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

        $query = "INSERT INTO vendedor (Nombre, Telefono, Direccion, Puesto, Contrasena) VALUES ('$nombre', $telefono, '$domicilio', '$puesto', '$passwordHash');";

        $resultado = mysqli_query($db, $query);

        if($resultado){
            echo'<script type="text/javascript">
                    alert("Usuario Agregado Correctamente");
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

        <h1>Agregar un Empleado</h1>

        <?php foreach($errores as $error) :  ?>
            <div class="text-center alert error">
                <?php echo $error;?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="agregarVendedor.php" enctype="multipart/form-data">
            <fieldset>
                <legend> Información sobre el Empleado</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Nombre Completo del Empleado" id="nombre" name="nombre"  value="<?php echo $nombre;?>" required>

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Teléfono del Empleado" id="telefono" name="telefono" value="<?php echo $telefono;?>" required>

                <label for="domicilio">Domicilio</label>
                <input type="text" placeholder="Domicilio del Empleado" id="domicilio" name="domicilio" value="<?php echo $domicilio;?>" required>

                <label for="puesto">Puesto</label>
                <select id="puesto" name="puesto" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="vendedor" <?php echo $puesto === 'vendedor' ? 'selected' : '';?>>Vendedor</option>
                    <option value="administrador" <?php echo $puesto === 'administrador' ? 'selected' : '';?>>Administrador</option>
                </select>

                <label for="password">Contraseña</label>
                <input type="password" placeholder="Este Campo lo Tiene que Llenar el Empleado" id="password" name="password" required>

                <label for="passwordConf">Confirmar Contraseña</label>
                <input type="password" placeholder="Ingresar Nuevamente la Contraseña" id="passwordConf" name="passwordConf" required>

            </fieldset>

            <input type="submit" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>