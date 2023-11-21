<?php
session_start();
require_once('conexion.php');

if (isset($_POST['submit'])) {

    if (isset($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['password'], $_POST['repassword']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {

        //Fecha y Hora Actualizada//
        date_default_timezone_set('America/Argentina/Tucuman');
        $date = date('Y-m-d H:i:s');

        /// Saneamiento y recorte de valores de entrada
        $firstName = $_POST['nombre'];
        $lastName = $_POST['apellido'];
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        // Comprueba si las contraseñas coinciden
        if ($password !== $repassword) {
            $errors[] = 'Las contraseñas no coinciden';
        } else {

            // Hash de la contraseña
            $options = array("cost" => 4);
            $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);

            // valida si una dirección de correo electrónico es válida
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = 'select * from users where email = :email';
                $stmt = $conexion->prepare($sql);
                $p = ['email' => $email];
                $stmt->execute($p);



                // Si la consulta no devolvió resultados, entonces se prepara otra consulta SQL utilizando la sentencia "insert into" para insertar un nuevo registro en la tabla de usuarios con los valores especificados

                if ($stmt->rowCount() == 0) {
                    $sql = "insert into users (nombre, apellido, email, password, created_at,updated_at) values(:vnombre,:vapellido,:email,:pass,:created_at,:updated_at)";

                    //realiza la insercion de valores en una tabla de una base de dato
                    try {
                        $handle = $conexion->prepare($sql);
                        $params = [
                            ':vnombre' => $firstName,
                            ':vapellido' => $lastName,
                            ':email' => $email,
                            ':pass' => $hashPassword,
                            ':created_at' => $date,
                            ':updated_at' => $date
                        ];

                        $handle->execute($params);

                        $success = 'Usuario creado correctamente!!';
                    } catch (PDOException $e) {
                        $errors[] = $e->getMessage();
                    }
                } else {
                    $valFirstName = $firstName;
                    $valLastName = $lastName;
                    $valEmail = '';
                    $valpassword  = $password;
                    $errors[] = 'el Email ya esta registrado';
                }
            } else {
                $errors[] = "el Email no es valido";
            }
        }
    } else {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            // $valFirstName = '';
            $errors[] = 'El nombre es requerido';
        } else {
            $valFirstName = $_POST['nombre'];
        }

        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            // $valFirstName = '';
            $errors[] = 'El apellido es requerido';
        } else {
            $valFirstName = $_POST['apellido'];
        }

        if (!isset($_POST['email']) || empty($_POST['email'])) {
            // $valFirstName = '';
            $errors[] = 'El email es requerido';
        } else {
            $valFirstName = $_POST['email'];
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {
            // $valFirstName = '';
            $errors[] = 'El password es requerido';
        } else {
            $valFirstName = $_POST['password'];
        }

        if (!isset($_POST['repassword']) || empty($_POST['repassword'])) {
            // $valFirstName = '';
            $errors[] = 'El repassword es requerido';
        } else {
            $valFirstName = $_POST['password'];
        }
    }
}

?>

<!-- /////////////////////////////////////////////////////// -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="./output.css" rel="stylesheet">
    <title>Register Craftsy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Poppins:ital,wght@0,700;1,200;1,600&family=Pridi:wght@300;400&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col h-screen font-[Poppins] bg-gradient-to-t from-[#fbc2eb] to-[#a6c1ee]">

    <div class="flex-grow">

        <section class="max-w-xl mx-auto rounded-md">

            <div class="bg-white max-w-md mx-auto p-8 rounded-lg mt-4">

                <div class="text-center">
                    <h3 class="text-2xl font-bold inline text-gray-500 mb-2">Registrese</h3>
                </div>

                <?php
                if (isset($_POST['submit'])) {

                    if (isset($errors) && count($errors) > 0) {
                        foreach ($errors as $error_msg) {
                            echo '<div class="text-red-500 text-center">' . $error_msg . '</div>';
                        }
                    }
                }
                if (isset($success)) {

                    echo '<div class="alert alert-success">' . $success . '</div>';
                }
                ?>

                <!-- ///////////////////////////////  FORM  //////////////////// -->
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <div class="grid grid-cols-1 mt-4 sm:grid-cols-2">

                        <!-- ///////////////////CORREGIR///////////////// -->
                        <div class="flex gap-6 flex-wrap ml-4">

                            <div class="">

                                <!-- <label class="block text-gray-500 text-sm font-bold mb-2" for="inputFirstName">Nombre</label> -->

                                <input class="block w-full px-4 py-2  text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" name="nombre" id="inputFirstName" placeholder="Nombre" type="text" />

                            </div>


                            <div class="">

                                <!-- <label class="block text-gray-500 text-sm font-bold mb-2" for="inputLastName">Apellido</label> -->

                                <input class="block w-full px-4 py-2  text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" name="apellido" id="inputLastName" placeholder="Apellido" type="text" />

                            </div>


                            <div class="">

                                <!-- <label class="block text-gray-500 text-sm font-bold mb-2" for="inputEmail">Mail</label> -->

                                <input class="block w-full px-4 py-2  text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" name="email" id="inputEmail" placeholder="Email" type="email" />

                            </div>


                            <div class="">

                                <!-- <label class="block text-gray-500 text-sm font-bold mb-2" for="Password">Contraseña</label> -->

                                <input class="block w-full px-4 py-2  text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" name="password" id="Password" placeholder="Contraseña" type="password" />

                            </div>

                            <div class="">

                                <!-- <label class="block text-gray-500 text-sm font-bold mb-2" for="Repassword">Confirmar Contraseña</label> -->

                                <input class="block w-full px-4 py-2  text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" name="repassword" id="Repassword" placeholder="Confirmar Contraseña" type="password" />

                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-3 mb-4">
                            <div class="mr-2">
                                <a class="text-gray-500  hover:text-[#8f6e81] text-dm" href="login.php">Ingresar</a>
                            </div>

                            <div class="  ">
                                <button type="submit" name="submit" class="mt-2 px-5 py-3 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600">Registrarse</button>
                            </div>
                        </div>

                </form>
            </div>
    </div>

    </section>
    </div>
    <footer class="py-4 bg-gray-200">
        <div class="container mx-auto px-18">
            <div class="flex items-center justify-between text-sm text-gray-500">
                <div class="text-muted">Bienvenido &copy; Dario Fabersani 2023</div>
                <div>
                    <h6 class="font-bold">Mi primer Sitio Web 2023</h6>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/scripts.js"></script>
</body>

</html>