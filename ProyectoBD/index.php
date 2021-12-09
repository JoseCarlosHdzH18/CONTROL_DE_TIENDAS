<?php 
require 'includes/config/database.php';
require 'includes/funciones.php';

$db = conectarDB();

$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = mysqli_real_escape_string($db, $_POST['idEmpleado']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $query = "SELECT * FROM vendedor WHERE IdVendedor = $id;";

    $resultado = mysqli_query($db, $query);
    $usuario = mysqli_fetch_assoc($resultado);

    $auth = password_verify($password, $usuario['Contrasena']);

    if ($auth) {
        header('Location: principal.php');
    } else {
        $errores[] = "Contraseña o ID incorrectos";
    }
}

// Incluye el template
incluirTemplate('header');

?>

<body>
    <div class="login contenido-centrado">
        <h1>Inicia Sesión</h1>

        <?php foreach($errores as $error) :  ?>
            <div class="text-center alert error">
                <?php echo $error;?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="index.php" enctype="multipart/form-data">
            <fieldset>

                <label for="idEmpleado">ID</label>
                <input type="number" placeholder="ID" id="idEmpleado" name="idEmpleado" required>

                <label for="password">Contraseña</label>
                <input type="password" placeholder="Contraseña" id="password" name="password" required>

                <input type="submit" value="Iniciar Sesión" class="boton">

            </fieldset>

        </form>
    </div>

    <script src="js/app.js"></script>
</body>

</html>