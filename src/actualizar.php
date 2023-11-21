<?php
// Conexion
require('conexion.php');

$errors = [];

// Si se envió el formulario
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $nombre_producto = $_POST["nombre_producto"];
    $descripcion_producto = $_POST["descripcion_producto"];
    $garantia_devolucion = $_POST["garantia_devolucion"];
    $precio = $_POST["precio"];
    $id = $_POST['id'];

    // Validación del campo 'nombre_producto'
    if (empty($nombre_producto)) {
        $errors[] = "El nombre del producto es requerido.";
        $mensaje_error = "El nombre del producto es requerido.";
    }
    ///////////////////////////////////////////////////////////////////////
    // Validación del campo 'descripcion_producto'
    if (empty($descripcion_producto)) {
        $errors[] = "La Descripcion del producto es requerido.";
        $mensaje_error = "La Descripcion del producto es requerido.";
    }
    /////////////////////////////////////////////////////////////////////////////////////
    // Validación del campo 'garantia_devolucion'
    if (empty($garantia_devolucion)) {
        $errors[] = "La Garantia de Devolucion del producto es requerido.";
        $mensaje_error = "La Garantia de Devolucion del producto es requerido.";
    }
    //////////////////////////////////////////////////////////////
    // Validación del campo 'precio'
    if (empty($precio)) {
        $errors[] = "El precio es requerido.";
        $mensaje_error = "El precio es requerido.";
    } elseif (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
        $errors[] = "El precio debe ser un valor numérico.";
        $mensaje_error = "El precio debe ser un valor numérico.";
    }
    // Si no hay errores de validación
    if (empty($errors)) {
        $nuevo_archivo_nombre = null;

        if (!empty($_FILES['thumb']['name'])) {

            $archivo_nombre = $_FILES['thumb']['name'];

            $archivo_extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);

            $nuevo_archivo_nombre = uniqid() . '.' . $archivo_extension;

            $lugar_archivo_temporal = $_FILES['thumb']['tmp_name'];
            /////////////////////////////////////////////////////////////////////////
            // Validación del campo 'imagen'
            if (empty($thumb)) {
                $errors[] = "La imagen es requerida.";
                $mensaje_error = "La imagen es requerida.";
            }
            move_uploaded_file($lugar_archivo_temporal, '../foto/' .

                $nuevo_archivo_nombre);
        } else {
            $nuevo_archivo_nombre = $_POST['current_thumb'];
        }


        $consulta = $conexion->prepare("UPDATE articulo SET nombre_del_producto=?, descripcion_del_producto=?, thumb=?, garantia_politica_de_devolucion=?, precio=? WHERE id=?");

        $consulta->execute([$nombre_producto, $descripcion_producto, $nuevo_archivo_nombre, $garantia_devolucion, $precio, $id]);

        header("Location: menu.php?mensaje=" . urlencode("¡Producto actualizado exitosamente!"));
        exit();
    }
}

if (isset($_GET['id'])) {  //comprueba si está definido y no son nulo, luego le asigna un valor a la variable id.
    $id = $_GET['id'];
}

$sql = "SELECT * FROM articulo WHERE id = :id"; //Esta línea de código crea una consulta SQL que busca todos los datos de la tabla articulo donde el valor de la columna id es igual al valor de un parámetro llamado :id.

$stmt = $conexion->prepare($sql); //prepara la consulta SQL anteriormente creada para ser ejecutada en la base de datos.

$stmt->bindParam(':id', $id); //vincula el valor de la variable $id al parámetro :id de la consulta SQL.

$stmt->execute(); //ejecuta la consulta SQL preparada anteriormente.

$articulo = $stmt->fetch(PDO::FETCH_ASSOC); //devuelve lo valores

?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////// -->



<?php

require_once('header.php');

?>

<body class="font-[Poppins] bg-emerald-100 h-screen">

    <div class="py-6">

        <section class="max-w-xl p-6 mx-auto rounded-md shadow-lg mt-10">

            <div>
                <h1 class="text-2xl font-bold inline text-gray-700 text-center mb-2">
                    Formulario para editar artículos
                </h1>
            </div>
            <?php if (isset($mensaje_error) && !empty($mensaje_error)) : ?>
                <div class="mensaje_error"><?php echo $mensaje_error; ?></div>
            <?php endif; ?>


            <form action="actualizar.php" method="POST" enctype="multipart/form-data">

                <div class="grid grid-cols-1 mt-4 sm:grid-cols-2">

                    <!-- ///////////////////////////////////////////////// -->
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_thumb" value="<?php echo $articulo['thumb']; ?>">


                    <!-- /////////////////////LA IMAGEN////////////////////////////// -->
                    <div class="mb-4">

                        <img class="w-auto h-auto flex rounded-lg border border-gray-300 sm:w-32 md:w-48 lg:w-64" src="../foto/<?php echo $articulo['thumb']; ?>" alt="Imagen actual del producto">

                        <div>
                            <input class="block w-auto px-2 py-2 mt-2 text-gray-700 bg-emerald-100 border rounded-md focus:border-blue-500 focus:outline-none focus:ring" type="file" name="thumb">
                        </div>
                    </div>


                    <!-- ////////////////////////////////PRIMERA FILA///////////////////////////////// -->
                    <div class="flex gap-6 flex-wrap ">

                        <div class="">

                            <label class=" text-gray-700 text-sm font-bold">Nombre del producto:</label>

                            <input class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" type="text" name="nombre_producto" value="<?php echo $articulo['nombre_del_producto']; ?>">

                        </div>


                        <div class="mb-4">

                            <label class="block  text-gray-700 mb-2 text-md font-bold">Precio:</label>

                            <input class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" type="text" name="precio" value="<?php echo $articulo['precio']; ?>">

                        </div>

                    </div>


                    <!-- ////////////////////////////////SEGUNDA FILA///////////////////////////////// -->
                    <div class="flex gap-6 flex-wrap">

                        <div class="">

                            <label class="block text-gray-700 text-sm font-bold">Garantía del producto:</label>

                            <textarea class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" name="garantia_devolucion"><?php echo $articulo['garantia_politica_de_devolucion']; ?></textarea>

                        </div>


                        <div class="mb-6">

                            <label class="block text-gray-700 text-sm font-bold">Descripción del producto:</label>

                            <textarea class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" name="descripcion_producto"><?php echo $articulo['descripcion_del_producto']; ?></textarea>

                        </div>
                    </div>
                </div>


                <!-- ///////////////////////BUTTON////////////////////////// -->
                <div class="flex justify-end mt-6 gap-3 flex-wrap">

                    <input type="submit" name="submit" value="Editar" class="px-6  py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600">

                    <a class="px-3 py-2 text-white transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600" href="menu.php">
                        Regresar
                    </a>

                </div>

            </form>
        </section>
    </div>

</body>

</html>