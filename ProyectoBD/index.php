<?php
require 'includes/funciones.php';
// Incluye el template
incluirTemplate('header');

?>

<body>
    <div class="login contenido-centrado">
        <h1>Inicia Sesión</h1>
        <form action="#" class="formulario" id="login">
            <fieldset>

                <label for="idEmpleado">ID</label>
                <input type="number" placeholder="ID" id="idEmpleado" required>

                <label for="password">Contraseña</label>
                <input type="password" placeholder="Contraseña" id="password" required>

                <input type="submit" value="Iniciar Sesión" class="boton">

            </fieldset>

        </form>
    </div>

    <script src="js/app.js"></script>
</body>

</html>