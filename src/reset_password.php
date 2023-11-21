<?php

require_once 'conexion.php';

// está verificando si se ha enviado un formulario utilizando el método POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Estas líneas obtienen los valores enviados desde el formulario utilizando el metodo POST.
  $token = $_POST["token"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirm_password"];

  // Esta condición verifica si las contraseñas ingresadas coinciden.
  if ($password !== $confirmPassword) {
    $error = "Las contraseñas no coinciden.";
  } else {
    // stas líneas preparan y ejecutan una consulta SQL en la base de datos.El resultado de la consulta se guarda en la variable $result.
    $stmt = $conexion->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_created_at >= (NOW() - INTERVAL 1 HOUR)");
    $stmt->execute([$token]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Estas líneas verifican si la consulta anterior devuelve algún resultado. Si la cantidad de resultados es mayor a 0, significa que el token es válido y no ha expirado.
    if (count($result) > 0) {
      // Hash de la contraseña
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Actualizar la contraseña en la base de datos
      $stmt = $conexion->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_created_at = NULL WHERE reset_token = ?");
      $stmt->execute([$hashedPassword, $token]);

      // Mostrar un mensaje de éxito al usuario
      $success = "La contraseña se ha restablecido correctamente.";
    } else {
      $error = "El enlace para restablecer la contraseña no es válido o ha expirado.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="./output.css" rel="stylesheet">
  <title>Restablecer contraseña</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Poppins:ital,wght@0,700;1,200;1,600&family=Pridi:wght@300;400&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>


<body class="flex flex-col h-screen font-[Poppins] bg-gradient-to-t from-[#fbc2eb] to-[#a6c1ee]">

  <div class="flex-grow">

    <div class="max-w-md mx-auto p-4 mt-16">

      <div class="bg-white rounded-lg">

        <div class="p-1 flex items-center justify-center">

          <h2 class="text-xl py-2 text-gray-500">Restablecer contraseña</h2>

        </div>


        <?php if (isset($error)) { ?>
          <div class="text-red-500"><?php echo $error; ?></div>
        <?php } ?>
        <?php if (isset($success)) { ?>
          <div class="text-green-500"><?php echo $success; ?></div>
        <?php } ?>



        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">


        <div class="p-4 text-sm py-2 rounded-lg">

            <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">

            <div class="mb-4">
              <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Nueva contraseña">
            </div>

            <div class="mb-4">
              <input type="password" name="confirm_password" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Confirmar contraseña">
            </div>

            <div class="flex items-center justify-between mt-3 mb-4">
              <a class="text-sm text-gray-500 hover:text-gray-600" href="login.php">Ingresar</a>

              <button type="submit" name="submit" class="px-6 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600">Restablecer contraseña</button>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  <footer class="py-4 bg-gray-200">
    <div class="container mx-auto px-8">
      <div class="flex items-center justify-between text-sm text-gray-500">
        <div class="text-muted">Bienvenido &copy; Dario Fabersani 2023</div>
        <div>
          <h6 class="font-bold">Mi primer Sitio Web 2023</h6>
        </div>
      </div>
    </div>
  </footer>
  </div>
</body>




</html>