<?php

require_once 'conexion.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Obtener el correo electrónico enviado desde el formulario
  $email = $_POST["email"];

  // Validar el correo electrónico
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "El correo electrónico ingresado no es válido.";
  } else {

    // Sanitizar el correo electrónico
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Verificar si el correo electrónico existe en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
      // Generar un token único y seguro
      $token = uniqid();

      // Guardar el token y la fecha/hora actual en la base de datos
      $stmt = $conexion->prepare("UPDATE users SET reset_token = ?, reset_token_created_at = NOW() WHERE email = ?");
      $stmt->bindParam(1, $token);
      $stmt->bindParam(2, $email);
      $stmt->execute();

      // Enviar correo electrónico al usuario con el enlace de restablecimiento de contraseña
      $resetLink = "https://localhost/trabajosphp/admin/src/reset_password.php?token=" . $token;

      require '../email/vendor/autoload.php';

      // Configurar el objeto PHPMailer
      $mail = new PHPMailer(true);
      try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia esto al servidor SMTP correspondiente
        $mail->SMTPAuth = true;
        $mail->Username = 'soportecraftsy@gmail.com'; // Cambia esto al correo electrónico del remitente
        $mail->Password = 'hopkxkbznyzkfdzg'; // Cambia esto a la contraseña del remitente
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('soportecraftsy@gmail.com', 'Craftsy');
        $mail->addAddress($email); // Agrega la dirección de correo electrónico del destinatario

        $mail->isHTML(true);
        $mail->Subject = 'Restablecimiento de Contraseña';
        $mail->Body = 'Haz clic en el siguiente enlace para restablecer tu contraseña: <a href="' . $resetLink . '">' . $resetLink . '</a>';

        $mail->send();
        $success = "Se ha enviado un correo electrónico a su mail.";
      } catch (Exception $e) {
        $error = 'No se pudo enviar el correo electrónico: ' . $mail->ErrorInfo;
      }
    } else {
      $error = "No se encontró un mail asociado a esta cuenta.";
    }
  }
}
?>

<!-- html para el formulario de recuperacion de contraseña -->



<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="./output.css" rel="stylesheet">
  <title>Olvide mi Contraseña</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Poppins:ital,wght@0,700;1,200;1,600&family=Pridi:wght@300;400&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>


<body class="flex flex-col h-screen font-[Poppins] bg-gradient-to-t from-[#fbc2eb] to-[#a6c1ee]">

  <div class="flex-grow">

    <div class="max-w-md mx-auto p-4 mt-16">

      <div class="bg-white rounded-lg">

        <div class="p-1 flex items-center justify-center">

          <h2 class="text-xl py-2 text-gray-500">Olvide mi Contraseña</h2>

        </div>

        <?php if (isset($error)) { ?>
          <div class="text-red-500 text-sm text-center"><?php echo $error; ?></div>
        <?php } ?>
        <?php if (isset($success)) { ?>
          <div class="text-green-500 text-sm text-center"><?php echo $success; ?></div>
        <?php } ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">


          <div class="max-w-sm mx-auto p-2 rounded-lg">

            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Correo electrónico">

            <div class="flex items-center justify-between mt-4">

              <a class="text-sm text-gray-500 hover:text-gray-600" href="login.php">Loguearse</a>

              <button type="submit" name="submit" class="px-6 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600">Enviar</button>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  </main>

  <div class="mt-">
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
  </div>


</body>


</html>