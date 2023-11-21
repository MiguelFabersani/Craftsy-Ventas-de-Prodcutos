<?php

//inicia una nueva sesion o reanuda la sesion
session_start();


// Verificar si el usuario ya ha iniciado sesión

if (!isset($_SESSION['id'])) {
    if (!strpos($_SERVER['REQUEST_URI'], 'login.php')) {
        header("Location: login.php");
        exit;
    }
}

//inclulle archivos php en otro archivos 
require_once('conexion.php');

//comprueba si se anviado un formulario html a tarves del metodo post
if (isset($_POST['submit'])) {

    //valida los datos enviados por un formulario corroborando que estos esten definidos y que no sean nulo, como qasi tambien que no esten vacios 
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

        // limpia los espacio en blanco
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        //valida el formato del correo electrónico proporcionado
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            //realiza una consulta a la base de datos para obtener los datos correspondientes del mail correspondiente
            $sql = "select * from users where email = :email";
            $handle = $conexion->prepare($sql);
            $params = ['email' => $email];
            $handle->execute($params);


            //aseguran el acceso a un sitio web, comprobando las contraseñeas y redirigiendo al menu, en caso de dar error emite el mensaje
            if ($handle->rowCount() > 0) {
                $getRow = $handle->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $getRow['password'])) {
                    unset($getRow['password']);
                    $_SESSION = $getRow;
                    header('location:menu.php');
                    exit();
                } else {
                    $errors[] = "Error en el Email o en la Contraseña";
                }
            } else {
                $errors[] = "Error en el Email o en la Contraseña";
            }
        } else {
            $errors[] = "Email no valido";
        }
    } else {
        $errors[] = "Email y Contraseña son requeridos";
    }
}

?>


<!--///////////////////////////////////////////////////////////////////-->




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="./output.css" rel="stylesheet">
    <title>Login Craftsy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Poppins:ital,wght@0,700;1,200;1,600&family=Pridi:wght@300;400&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>


<body class="font-[Poppins] bg-gradient-to-t from-[#fbc2eb] to-[#a6c1ee] h-screen">

    <div class="flex flex-col min-h-screen">

        <main class="flex-grow">

            <div class="max-w-md mx-auto p-8">

                <div class="bg-white rounded-lg mt-8">

                    <div class="py-4 flex items-center justify-center">
                        <h3 class="text-3xl text-gray-500">Loguearse</h3>
                    </div>

                    <?php
                    if (isset($errors) && count($errors) > 0) {
                        foreach ($errors as $error_msg) {
                            echo '<div class="text-red-500 text-center">' . $error_msg . '</div>';
                        }
                    }
                    ?>


                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                        <div class="p-4 text-sm py-2 rounded-lg">

                            <div class="mb-4">
                                <!-- <label class="block text-gray-500 text-sm font-bold mb-2" for="inputEmail">Dirección de correo electrónico.</label> -->
                                <input class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500" name="email" id="inputEmail" placeholder="Dirección de correo electrónico" type="email" />
                            </div>

                            <div class="mb-4">
                                <!-- <label class="block text-gray-500 text-sm font-bold mb-2" for="inputPassword">Contraseña.</label> -->
                                <input class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500" name="password" id="inputPassword" placeholder="Contraseña" type="password" />
                            </div>

                            <div class="flex items-center justify-between mt-2 mb-1">

                                <a class="text-sm text-gray-500 hover:text-gray-600" href="forgot_password.php">¿Olvidó su contraseña?</a>

                                <button type="submit" name="submit" class="px-6 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600">Login</button>
                            </div>
                    </form>
                </div>

                <div class="card-footer text-center">

                    <div class="flex items-center justify-center py-2">

                        <div class="small">

                            <a class="text-gray-500 hover:text-[#8f6e81] text-dm" href="register.php">Regístrese</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>




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