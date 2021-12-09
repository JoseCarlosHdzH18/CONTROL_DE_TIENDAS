<?php
require 'includes/config/database.php';
require 'includes/funciones.php';

incluirTemplate('header');

$db = conectarDB();
$query = "SELECT * FROM sucursal";
$resultado = mysqli_query($db, $query);
?>
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
    <body>
        <form class="formulario" method="POST" action="tablaVenta.php">
            <fieldset>
                <legend>Punto de venta</legend>

                <label for="sucursales">Sucursal:</label>
                <select id="sucursales" name="sucursales" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php while ($sucursal = mysqli_fetch_assoc($resultado)) : ?>
                        <option value="<?php echo $sucursal['IdSucursal']; ?>"><?php echo $sucursal['Domicilio']; ?></option>
                    <?php endwhile; ?>
                </select>
                <input type="submit" class="boton" name="boton" value="Escoger Productos">
            </fieldset>
        </form>
    </body>
</main>

</html>