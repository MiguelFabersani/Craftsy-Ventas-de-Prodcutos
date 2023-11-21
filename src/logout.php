<?php

session_start(); // Iniciamos la sesión


if (isset($_SESSION['id'])) { // Verificamos si esta definido.
  session_destroy(); // destruye la sesion.
  unset($_SESSION['id']); // elimina el elemento id de sesion.
  header("Location: login.php"); // Redirigimos al usuario a la página de inicio.
} else {
  header("Location: error.php"); // Redirigimos al usuario a una página de error.
}
