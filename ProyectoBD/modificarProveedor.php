<?php 
require 'includes/funciones.php';
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

        <h1>Modificar un Proveedor</h1>

        <form class="formulario">
            <fieldset>
                <legend> Información sobre el Proveedor</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Nombre del proveedor" id="nombre" required>

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Teléfono del proveedor" id="telefono" required>

            </fieldset>

            <input type="submit" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>