<?php
# Necesitamos el conteo para saber cuántas páginas vamos a mostrar
$sentencia = $base_de_datos->query("SELECT count(*) AS conteo FROM articulo");
$conteo = $sentencia->fetchObject()->conteo;