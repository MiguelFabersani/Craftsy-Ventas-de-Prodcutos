<?php

require_once('conexion.php');

// Verificar si se recibió un valor de ID válido
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {

  header('Location: menu.php');

  exit();
}


// Preparar consulta para obtener el detalle del artículo
$consulta = $conexion->prepare("SELECT * FROM articulo WHERE id = ?");
$consulta->execute(array($_GET['id']));

// Verificar si se encontró un artículo con ese ID
if ($consulta->rowCount() == 0) {
  header('Location: menu.php');
  exit();
}

// Obtener los detalles del artículo de la base de datos
$datos = $consulta->fetch(PDO::FETCH_ASSOC);

// Establecer el encabezado para indicar que se está devolviendo un contenido JSON
header('Content-Type: application/json');

// Convertir el arreglo de detalles del artículo a formato JSON y enviarlo como respuesta
echo json_encode($datos);
?>