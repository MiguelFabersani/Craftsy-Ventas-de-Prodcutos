<?php
require_once('conexion.php');
require('header.php');
?>

<body class="flex w-full h-full ">


    <!-- /////BOTON CARGAR ARTICULO MODAL////// -->
    <div class="py-2 px-2 text-right mr-5">
        <button id="abrirModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Abrir Modal
        </button>
    </div>


    <!-- /////////Mensaje de PHP////////////// -->
    <?php
    $articulos = $conexion->query("SELECT * FROM articulo WHERE eliminado is null");
    if (isset($_GET['mensaje'])) {
        $mensaje = $_GET['mensaje'];
        echo '<p class=" success-message text-center bg-white-100 w-full text-green-500 rounded-md">' . htmlspecialchars($mensaje) . '</p>';
    }
    ?>



    <!-- //////////Listado de Articulos//////////// -->
    <div class="flex px-16">
        <div class="rounded-md w-full">
            <div class="flex flex-wrap gap-8 p-4">


                <?php
                $datos = array(); // Inicializa un arreglo vacío
                if ($articulos->rowCount() > 0) {
                    while ($fila = $articulos->fetch(PDO::FETCH_ASSOC)) {
                        $datos[] = $fila;
                        echo '<div class="flex-shrink-0 text-gray-700 shadow-lg rounded-md overflow-hidden">';
                        // IMAGEN
                        echo '<div class="flex  w-52 max-w-lg rounded-md">';
                        echo '<img class="mb-2 p-2 h-40 w-full object-cover mx-auto" src="../foto/' . $fila['thumb'] . '" alt="' . $fila['nombre_del_producto'] . '" width="300" height="200" />';
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
                        // FECHA DE INGRESO DE PRODUCTO
                        echo '<div class="flex ml-2 mb-2 items-center gap-11">';
                        echo '<label class="px-2 py-1 rounded-full text-sm bg-gray-200">Fecha:</label>';
                        echo '<h4 class="px-3 py-1 rounded-full text-sm bg-gray-300">' . $fila['created_at'] . '</h4>';
                        echo '</div>';
                        // ENLACES
                        // BOTONES
                        echo '<div class="flex mb-1 mr-3 justify-end gap-5 items-end">';
                        //////////////////////////////ver detalles//////////////////////////


                        // echo '<button id="crearModal" class=" bg-blue-200 hover:bg-blue-400 px-2 py-2 rounded-md font-medium tracking-wider transition" onclick="window.location.href=\'detalles_articulo.php?id=' . $fila['id'] . '\'"><i class="fas fa-eye"></i></button>'; -->

                        echo '<button id="abrirModal" class="bg-blue-200 hover:bg-blue-400 px-2 py-2 rounded-md font-medium tracking-wider transition" onclick="abrirDetalleModal(' . $fila['id'] . ');" aria-label="Ver detalles del producto ' . htmlspecialchars($fila['id'], ENT_QUOTES, 'UTF-8') . '">Ver</button>';



                        ///////////////////////////editar producto/////////////////////////////
                        echo '<button class=" bg-yellow-200 hover:bg-yellow-400 px-2 py-2 rounded-md font-medium tracking-wider transition" onclick="window.location.href=\'actualizar.php?id=' . $fila['id'] . '\'"><i class="fas fa-pencil-alt"></i></button>';


                        //////////////////////eliminar prodcuto//////////////////////////////////////

                        echo '<button id="eliminarBtn-' . $fila['id'] . '" class="bg-red-200 hover:bg-red-400 px-2 py-2 rounded-md font-medium tracking-wider transition" data-nombre="' . $fila['nombre_del_producto'] . '" data-id="' . $fila['id'] . '"><i class="fas fa-trash"></i></button>';

                        echo '</div>';

                        echo '</div>';
                    }
                } else {
                    echo '<div class="w-full">';
                    echo '<p class="text-red-500 text-center text-xl">No se encontraron resultados</p>';
                    echo '</div>';
                }

                ?>
            </div>

        </div>
    </div>

    <!-- Modal para Crear Producto -->
    <?php
    require_once('create_modal.php');
    ?>


    <!-- Modal para Ver Producto -->
    <?php
    require_once('detalle_modal.php');
    ?>



    <?php

    ?>

    <!-- Script -->


    <script src="cargar_articulo.js"></script>
    <script src="detalle_articulo.js"></script>
    <script src="eliminar_articulo.js"></script>


</body>