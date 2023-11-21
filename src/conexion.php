<?php

$servername = "localhost";  //establece el nombre del servidor
$username = "root";  //: es el nombre de usuario que se utiliza para acceder a la base de datos
$password = "";  //se especifica la contraseña para acceder a la base de datos, en este caso se deja en blanco, no se utiliza ninguna contraseña
$dbname = "demo";  //este es el nombre de la base de datos a la que se desea conectarse

try {
	$conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);  //crea una nueva instancia de la clase PDO y establece una conexión con una base de datos
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //establece el modo de manejo de errores para la conexión PDO y en caso que existan errores se lanza excepciones
} catch (PDOException $e) {   //se ejecuta si se produce una excepción de tipo PDOException en el bloque de código
	echo "Conexión fallida: " . $e->getMessage();   //se utiliza para imprimir un mensaje de error en caso de que se produzca
}
