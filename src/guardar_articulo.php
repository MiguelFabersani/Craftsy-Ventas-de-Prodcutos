<?php
require_once('conexion.php');
$errors = [];

    $nombre_producto = $_POST["nombre_producto"];
    $descripcion_producto = $_POST["descripcion_producto"];
    $garantia_devolucion = $_POST["garantia_devolucion"];
    $precio = $_POST["precio"];
    $fecha = $_POST["fecha"];

    // Validación del campo 'nombre_producto'
    if (empty($nombre_producto)) {
        $errors[] = "El nombre del producto es requerido.";
        $mensaje_error = "El nombre del producto es requerido.";
    }

    // Validación del campo 'descripcion_producto'
    if (empty($descripcion_producto)) {
        $errors[] = "La Descripcion del producto es requerida.";
        $mensaje_error = "La Descripcion del producto es requerida.";
    }

    // Validación del campo 'garantia_devolucion'
    if (empty($garantia_devolucion)) {
        $errors[] = "La Garantia de Devolucion del producto es requerida.";
        $mensaje_error = "La Garantia de Devolucion del producto es requerida.";
    }

    // Validación del campo 'precio'
    if (empty($precio)) {
        $errors[] = "El precio es requerido.";
        $mensaje_error = "El precio es requerido.";
    } elseif (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
        $errors[] = "El precio debe ser un valor numérico.";
        $mensaje_error = "El precio debe ser un valor numérico.";
    }

    // Validación del campo 'fecha'
    if (empty($fecha)) {
        $errors[] = "La fecha es requerida.";
        $mensaje_error = "La fecha es requerida.";
    }

    // Si no hay errores de validación
    if (empty($errors)) {
        //Fecha y Hora Actualizada
        date_default_timezone_set('America/Argentina/Tucuman');
        $fecha = date('Y-m-d H:i:s');

        // Directorio donde se va a guardar la imagen
        $ruta_directorio = '../foto/';

        // Obtener el nombre del archivo y su extensión
        $archivo_nombre = $_FILES['thumb']['name'];
        $archivo_extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);

        // Generar un nuevo nombre de archivo para evitar conflictos de nombres
        $nuevo_archivo_nombre = uniqid() . '.' . $archivo_extension;

        // Validación del campo 'imagen'
        if (empty($archivo_nombre)) {
            $errors[] = "La imagen es requerida.";
            $mensaje_error = "La imagen es requerida.";
        } else {
            // Ruta temporal donde se guardó el archivo subido
            $lugar_archivo_temporal = $_FILES['thumb']['tmp_name'];

            // Mover el archivo a su ubicación final
            move_uploaded_file($lugar_archivo_temporal, $ruta_directorio . $nuevo_archivo_nombre);

            // Preparar la consulta que va a realizar en la tabla "articulo" y setear los valores con marcadores de posición
            $consulta = $conexion->prepare("INSERT INTO articulo (nombre_del_producto, descripcion_del_producto, thumb, garantia_politica_de_devolucion, precio, created_at) VALUES (?, ?, ?, ?, ?, ?)");

            $consulta->execute([$nombre_producto, $descripcion_producto, $nuevo_archivo_nombre, $garantia_devolucion, $precio, $fecha]);

            // Mensaje de éxito
            $mensaje = "¡Producto cargado exitosamente...!";

            // Redirigir al usuario al menú principal
            header("Location: menu.php?mensaje=" . urlencode($mensaje));
            // header("Location: menu.php");
            exit();
        }
    }
