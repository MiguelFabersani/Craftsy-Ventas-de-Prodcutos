<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="./output.css" rel="stylesheet">
    <title>Mostrar Artículos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-**********" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Poppins:ital,wght@0,700;1,200;1,600&family=Pridi:wght@300;400&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>
<?php

// require_once('header.php');

?>


<body class="flex w-full h-full bg-green-600">

    <div class="flex px-4 py-4">

        <div class="rounded-md">

            <div class="flex flex-wrap text-center gap-8 p-4">

                <?php
                require('conexion.php');

                $consulta = $conexion->query("SELECT * FROM articulo WHERE eliminado is null");

                if (isset($_GET['mensaje'])) {
                    $mensaje = $_GET['mensaje'];
                    echo '<p class=" success-message bg-white-100 h-2 w-full text-green-500 rounded-md">' . htmlspecialchars($mensaje) . '</p>';
                }

                if ($consulta->rowCount() > 0) {
                    while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {


                        echo '<div class="flex-shrink-0 text-gray-700 shadow-lg rounded-md overflow-hidden">';


                        // IMAGEN
                        echo '<div class="flex w-52 max-w-lg rounded-md">';

                        echo '<img class="mb-2 p-2 h-40 w-full object-cover mx-auto"  src="../foto/' . $fila['thumb'] . '" alt="' . $fila['nombre_del_producto'] . '" width="300" height="200" />';

                        echo '</div>';

                        // NOMBRE DEL PRODUCTO
                        echo '<div class="flex ml-2 mb-2 items-center gap-6">';
                        echo '<label class="px-2 py-1 rounded-full bg-gray-200">Nombre:</label>';

                        echo '<span class="px-2 py-1 rounded-full text-sm bg-gray-300">' . $fila['nombre_del_producto'] . '</span>';
                        echo '</div>';

                        // PRECIO DEL PRODUCTO
                        echo '<div class="flex ml-2 mb-2 items-center gap-11">';
                        echo '<span class="px-2 py-1 rounded-full text-sm bg-gray-200">Precio:</span>';
                        echo '<span class="px-3 py-1 rounded-full text-sm bg-gray-300">$' . $fila['precio'] . '</span>';
                        echo '</div>';


                        // // DESCRIPCIÓN DEL PRODUCTO
                        // echo '<div class="py-2">';
                        // echo '<label class="text-gray-500">Descripción del producto:</label>';
                        // echo '<p class="px-3 py-1 rounded-full text-sm bg-gray-500">' . $fila['descripcion_del_producto'] . '</p>';
                        // echo '</div>';


                        // // GARANTÍA
                        // echo '<div class="py-2">';
                        // echo '<label class="text-gray-500">Garantía y política de devolución:</label>';
                        // echo '<p class="px-3 py-1 rounded-full text-sm bg-gray-500">' . $fila['garantia_politica_de_devolucion'] . '</p>';
                        // echo '</div>';


                        // FECHA DE INGRESO DE PRODUCTO
                        echo '<div class="flex ml-2 mb-2 items-center gap-11">';
                        echo '<label class="px-2 py-1 rounded-full text-sm bg-gray-200">Fecha:</label>';
                        echo '<h4 class="px-3 py-1 rounded-full text-sm bg-gray-300">' . $fila['created_at'] . '</h4>';
                        echo '</div>';


                        // BOTONES PARA VER DETALLES, EDITAR Y ELIMINAR //
                        echo '<div class="flex mb-1 mr-3 justify-end gap-5 items-end">';


                        echo '<button class="bg-blue-200 hover:bg-blue-400 px-2 py-2 rounded-md font-medium tracking-wider transition" id="openModalButton(\'detalles_articulo.php?id=' . $fila['id'] . '\')"><i class="fas fa-eye"></i></button>';

                        echo '<button class="bg-yellow-200 hover:bg-yellow-400 px-2 py-2 rounded-md font-medium tracking-wider transition" onclick="openModalButton(\'actualizar.php?id=' . $fila['id'] . '\')"><i class="fas fa-pencil-alt"></i></button>';


                        echo '<button class="bg-red-200 hover:bg-red-400 px-2 py-2 rounded-md font-medium tracking-wider transition" onclick="confirmarEliminacion(' . $fila['id'] . ')"><i class="fas fa-trash"></i></button>';

                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-red-500">No se encontraron resultados</p>';
                }
                ?>

            </div>
        </div>



        <!-- Modal oculto al principio -->
        <div id="myModal" class="modal invisible fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center">
            <div class="modal-box">
                <div class="modal-content p-5 bg-white rounded-lg shadow-lg">
                    <!-- Contenido del modal -->

                    <?php

                    require_once('actualizar.php');

                    ?>



                    <!-- Botón para cerrar el modal -->
                    <button id="closeModalButton" class="bg-red-500 text-white hover:bg-red-600 py-2 px-4 mt-3 rounded-full">Cerrar Modal</button>
                </div>
            </div>
        </div>


        <!-- ////////////////Confirmar Eliminacion (Javascript) este es el correcto//////////// -->
        <script>
            function confirmarEliminacion() {
                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    window.location.href = 'menu.php?id=<?php echo urlencode($nombre_del_producto); ?>&confirm=1';
                }
            }
        </script>

        <!-- //////////////////////modal de ver detalles y de editar producto///////////////////////////////// -->

        <script>
            const modal = document.getElementById('myModal');
            const openModalButton = document.getElementById('openModalButton');
            const closeModalButton = document.getElementById('closeModalButton');

            // Abrir el modal
            openModalButton.addEventListener('click', () => {
                modal.classList.remove('invisible');
            });

            // Cerrar el modal haciendo clic en el fondo oscuro
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('invisible');
                }
            });

            // Cerrar el modal haciendo clic en el botón de cerrar
            closeModalButton.addEventListener('click', () => {
                modal.classList.add('invisible');
            });

            // function confirmarEliminacion(id) {
            //     if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            //         window.location.href = 'delete.php?id=' + id + '&confirm=1';
            //     }
            // }
        </script>













        <!-- <script>
            function abrirModal(url) {
                document.getElementById("myModal").style.display = "block";
                document.getElementById("iframe").src = url;
            }


            function cerrarModal() {
                document.getElementById("myModal").style.display = "none";
                document.getElementById("iframe").src = ""; // Limpiar la fuente del iframe al cerrar
            }


            ////este es el incorrecto/////
            function confirmarEliminacion(id) {
                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    window.location.href = 'delete.php?id=' + id + '&confirm=1';
                }
            }
        </script> -->


</body>

</html>