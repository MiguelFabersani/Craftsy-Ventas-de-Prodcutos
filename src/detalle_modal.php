<body>
    <div id="detalleModal" class="fixed inset-0 flex items-center justify-center invisible bg-opacity-50">

        <div class="modal-container fixed inset-0 overflow-y-auto md:max-w-md z-50 "></div>

        <div class="modal-container bg-white md:max-w-md mt-16 mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">

            <section class=" p-1 mx-auto rounded-md shadow-lg">

                <div class="container mx-auto p-2">

                    <div class="max-w-lg mx-auto rounded-lg ">

                        <!-- ///////////////////////IMAGEN//////////////////////////// -->

                        <div class="flex">

                            <img id="imagenProducto" class="mx-auto w-max h-48 object-contain rounded-lg border border-gray-300" src="../foto/<?php echo isset($datos['thumb']) ? $datos['thumb'] : ''; ?>" width="200" height="200" alt="<?php echo isset($datos['nombre_del_producto']) ? $datos['nombre_del_producto'] : ''; ?>" />

                        </div>

                        <!-- ////////////////////////////////PRIMERA FILA///////////////////////////////// -->
                        <div class="flex gap-14 mt-4 ml-4">

                            <div class="">

                                <h2 class="cursor-pointer transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600 text-white px-4 py-2 font-bold">Nombre del producto:
                                </h2>

                                <h2 id="nombreProducto" class="text-3xl font-semibold text-gray-800"><?php echo isset($datos['nombre_del_producto']) ? $datos['nombre_del_producto'] : ''; ?>
                                </h2>
                            </div>

                            <div class="">

                                <h2 class="cursor-pointer transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600 text-white px-4 py-2 font-bold">Precio:</h2>

                                <h4 id="precioProducto" class="mb-2 text-2xl block font-bold text-blue-500">$<?php echo isset($datos['precio']) ? $datos['precio'] : ''; ?></h4>
                            </div>
                        </div>

                        <!-- ////////////////////////////////SEGUNDA FILA///////////////////////////////// -->
                        <div class="flex gap-14 mt-4 ml-2">

                            <div class="">


                                <h2 class="cursor-pointer transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600 text-white px-4 py-2 font-bold">
                                    Garantia del Producto:
                                </h2>

                                <div x-show="open" class="accordion-content px-4 py-2">

                                    <p id="garantiaProducto" class="text-gray-600 normal-case"><?php echo isset($datos['garantia_politica_de_devolucion']) ? $datos['garantia_politica_de_devolucion'] : ''; ?></p>
                                </div>

                            </div>

                            <div class="">


                                <h2 class="cursor-pointer transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600 text-white px-4 py-2 font-bold">
                                    Descripción del Producto:
                                </h2>

                                <div x-show="open" class="accordion-content px-4 py-2">

                                    <p id="descripcionProducto" class="text-gray-600 normal-case"><?php echo isset($datos['descripcion_del_producto']) ? $datos['descripcion_del_producto'] : ''; ?></p>

                                </div>

                            </div>
                        </div>

                        <!-- ////////////////////////////////TERCERA FILA///////////////////////////////// -->
                        <div class="flex gap-14 mt-4 justify-center ml-2">

                            <div class="">

                                <h2 class="cursor-pointer transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600 text-white px-4 py-2 font-bold">Fecha de cración:</h2>

                                <h4 id="fechaProducto" class="py-1 text-dm text-gray-500"><?php echo isset($datos['created_at']) ? $datos['created_at'] : ''; ?></h4>

                            </div>

                        </div>

                        <div class="flex justify-end">
                            <button id="cerrarModal" class="modal-close bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Cerrar
                            </button>
                        </div>

                    </div>
                </div>
            </section>
        </div>