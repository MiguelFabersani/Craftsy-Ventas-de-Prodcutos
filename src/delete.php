<?php

require('conexion.php');

$id = $_GET['id'];   //asigna a la variable el valor de id a traves de la URL

if (isset($_GET['confirm'])) {

    $sql = "UPDATE articulo SET eliminado = 1 WHERE id = :id"; //es una consulta sql que actualiza la tabla articulo de la base de datos, la misma no elimina prodcutos de la base de datos pero si de las vistas, y que solamente actualizara con el valor id seleccionado

    $stmt = $conexion->prepare($sql);  //prepara la consulta sql (la preparación de la consulta es para validar la sintaxis de la consulta SQL y se establece una comunicación con la base de datos para poder ejecutarla.)

    $stmt->bindParam(':id', $id); //es la ejecucion de la consulta antes preparada

    $stmt->execute();  //ejecuta la consulta preparada anteriormente

    header('location:menu.php');  //redirige al archivo deseado

    exit;
}


?>



