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

        <h1>Modificar un Producto del Inventario</h1>

        <form class="formulario">
            <fieldset>
                <legend> Información sobre el Producto</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Nombre del producto" id="nombre" required>

                <label for="marca">Marca</label>
                <input type="text" placeholder="Marca del producto" id="marca" required>

                <label for="precio">Precio de Venta</label>
                <input type="number" placeholder="Precio del producto" id="precio" min="0" required>

            </fieldset>

            <fieldset>
                <legend>Sucursal donde Ingresaran</legend>

                <label for="stock">Stock:</label>
                <input type="number" placeholder="Cantidad del producto" id="stock" min="1" required>

                <label for="sucursales">Sucursal:</label>
                <select id="sucursales" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="sucursal X">Sucursal X</option>
                    <option value="Sucursal Y">Sucursal Y</option>
                </select>

                <label for="stock">Precio de Compra</label>
                <input type="number" placeholder="Precio del producto por unidad" id="stock" min="1" required>
            </fieldset>


            <input type="submit" value="Guardar" class="boton">
        </form>

    </main>
</body>

</html>