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

        <h1>Modificar un Empleado</h1>

        <form class="formulario">
            <fieldset>
                <legend> Información sobre el Empleado</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Nombre Completo del Empleado" id="nombre" required>

                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="Teléfono del Empleado" id="telefono" required>

                <label for="domicilio">Domicilio</label>
                <input type="text" placeholder="Domicilio del Empleado" id="domicilio" required>

                <label for="puesto">Puesto</label>
                <select id="puesto" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="vendedor">Vendedor</option>
                    <option value="administrador">Administrador</option>
                </select>

                <label for="password">Contraseña</label>
                <input type="password" placeholder="Este Campo lo Tiene que Llenar el Empleado" id="password" required>

                <label for="password">Confirmar Contraseña</label>
                <input type="password" placeholder="Ingresar Nuevamente la Contraseña" id="password" required>

            </fieldset>

            <input type="submit" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>