<body>
    <div id="detalleModal" class="fixed inset-0 flex items-center justify-center z-50 invisible">
        <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>
        <div class="modal-container bg-white w-2/3 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto flex-col justify-center">
            <div class="py-5">
                <section class="max-w-2xl p-3 mx-auto rounded-md mt-1">
                    <div class="container mx-auto p-4">
                        <div class="max-w-lg mx-auto rounded-lg shadow-lg p-5 space-y-4">

                            <!-- /////////////////////IMAGEN////////////////////////////// -->
                            <div class="flex">

                                <img class="mx-auto w-max h-68 object-contain rounded-lg border border-gray-300" src="../foto/<?php echo isset($fila['thumb']) ? $fila['thumb'] : ''; ?>" width="200" height="200" alt="<?php echo isset($fila['nombre_del_producto']) ? $fila['nombre_del_producto'] : ''; ?>" />

                            </div>

                            <!-- ////////////////////////////////PRIMERA FILA///////////////////////////////// -->
                            <div class="flex gap-14 ml-4">
                                <div class="mb-4 ">
                                    <label class="block text-gray-700 text-dm mb-2 font-bold">Nombre del producto:</label>
                                    <h2 class="text-3xl font-semibold text-gray-800"><?php echo isset($fila['nombre_del_producto']) ? $fila['nombre_del_producto'] : ''; ?></h2>
                                </div>

                                <div class="mb-4">
                                    <label class="block ml-2 text-gray-700 mb-2 text-md font-bold">Precio:</label>
                                    <h4 class="mb-2 ml-2 text-2xl block font-bold text-blue-500">$<?php echo isset($fila['precio']) ? $fila['precio'] : ''; ?></h4>
                                </div>
                            </div>

                            <!-- ////////////////////////////////SEGUNDA FILA///////////////////////////////// -->
                            <div class="flex gap-14 ml-2">

                                <div class="mb-4">

                                    <div x-data="{ open: false }" class="accordion">

                                        <button @click="open = !open" class="cursor-pointer transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600 text-white px-4 py-2 font-bold">
                                            Garantia del Producto
                                        </button>

                                        <div x-show="open" class="accordion-content px-4 py-2">

                                            <p class="text-gray-600 normal-case"><?php echo isset($fila['garantia_politica_de_devolucion']) ? $fila['garantia_politica_de_devolucion'] : ''; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">

                                    <div x-data="{ open: false }" class="accordion">

                                        <button @click="open = !open" class="cursor-pointer transition-colors transform bg-blue-500 rounded-md  focus:outline-none hover:bg-blue-600 text-white px-4 py-2 font-bold">
                                            Descripción del Producto
                                        </button>

                                        <div x-show="open" class="accordion-content px-4 py-2">

                                            <p class="text-gray-600 normal-case"><?php echo isset($fila['descripcion_del_producto']) ? $fila['descripcion_del_producto'] : ''; ?></p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ////////////////////////////////TERCERA FILA///////////////////////////////// -->
                            <div class="flex gap-14 justify-center ml-2">

                                <div class="mb-4 justify-center">

                                    <label class="block text-gray-700 text-dm justify-center mt-4 font-bold">Fecha de cración:</label>

                                    <h4 class="mb-4 text-dm text-gray-500"><?php echo isset($fila['created_at']) ? $fila['created_at'] : ''; ?></h4>

                                </div>

                            </div>

                            <div class=" flex justify-center">
                                <span class="modal-close cursor-pointer absolute top-2 right-4 text-2xl" onclick="cerrarModal()">&times;</span>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>