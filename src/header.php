<?php
/////////////////////////////Ususario ingresado bienvenido////////////////////////////////////
session_start();

if (!$_SESSION['id']) {
    header('location:login.php');
} else {
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Craftsy.com</title>
</head>

<body class="font-[Poppins] bg-emerald-100 h-screen">


    <div class="bg-blue-400 w-full py-3">

        <nav class=" mx-auto flex justify-between items-center w-[92%] bg-blue-400 ">

            <div>

                <img class="w-25" src="../image/logo.png" alt="logo" onclick="window.location.href='menu.php';">

            </div>

            <!-- Bienvenida y cierre de sesión -->

            <div class="flex items-center">


                <h2 class="text-lg mt-0 md:mt-3 text-white ">Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?>
                </h2>


                <div id="nav" class="nav-links absolute mt-4 bg-blue-400 duration-500 transition md:static left-0 text-sm text-center top-[-100%] md:w-auto w-full items-center px-5">
                    <ul class="flex md:flex-row flex-col top-1 md:items-center md:gap-6 gap-6">
                        <li>
                            <a class="hover:text-gray-500" href="logout.php">Cerrar Sesion</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <ion-icon onclick="onToggleMenu(this)" name="menu" class=" fas fa-bars text-3x1 cursor-pointer  md:hidden"></ion-icon>
            </div>

        </nav>

    </div>

    <script src="main.js"></script>

</body>

</html>