<body>

    <div id="miModal" class="fixed inset-0 flex items-center  justify-center invisible bg-opacity-50">

        <div class="modal-container bg-white  md:max-w-md rounded shadow-lg z-50 overflow-y-auto"></div>

        <div class="modal-container bg-white md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">

            <section class=" p-6 mx-auto rounded-md shadow-lg mt-10">

                <div class="text-center">

                    <h1 class="text-2xl font-bold inline text-gray-700 mb-2">
                        Formulario para agregar Artículos
                    </h1>
                </div>

                <!-- ///////////////////////////////  FORM  //////////////////// -->
                <div class="grid grid-cols-1  mt-4 sm:grid-cols-2">
                    <form action="guardar_articulo.php" method="POST" enctype="multipart/form-data">

                        <!-- ////////////////////////////////PRIMERA FILA///////////////////////////////// -->
                        <div class="flex gap-6 flex-wrap ml-4">
                            <div class="">
                                <label class=" text-gray-700 text-sm font-bold">Nombre del producto:</label>
                                <input type="text" name="nombre_producto" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" required>
                            </div>
                            <div class="mb-4 mt-1">
                                <label class="block text-gray-700 text-sm font-bold">Descripción del producto:</label>
                                <input name="descripcion_producto" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" required></input>
                            </div>
                        </div>

                        <!-- ////////////////////////////////SEGUNDA FILA///////////////////////////////// -->
                        <div class="flex gap-6 flex-wrap ml-4">
                            <div class="">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Garantía y política de devolución:</label>
                                <input name="garantia_devolucion" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"></input>
                            </div>
                            <div class="mb-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Fecha:</label>
                                <input type="date" name="fecha" required class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                            </div>
                        </div>

                        <!-- ////////////////////////////////TERCERA FILA///////////////////////////////// -->
                        <div class="flex gap-6 flex-wrap ml-4">
                            <div class="mb-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Precio:</label>
                                <input type="text" name="precio" required pattern="[0-9]+(\.[0-9]+)?" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" placeholder="Ingrese el precio (ejemplo: 10.99)">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">
                                    Imagen:
                                </label>
                                <div class="mt-1 px-3 pt-3 pb-2 border-2 border-gray-400 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-8 w-8 text-gray-700" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-gray-700 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span class="">Cargar un archivo</span>
                                                <input type="file" name="thumb" class="block w-60 px-2 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:outline-none focus:ring" required>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ///////////////////////BUTTON////////////////////////// -->
                        <div class="flex justify-end flex-wrap gap-3 mt-4">
                            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-500 rounded-md focus:outline-none hover:bg-blue-600">
                                Crear
                            </button>

                            <button id="cerrarModal" class="modal-close bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Cerrar
                            </button>
                        </div>
                    </form>
                </div>

            </section>
        </div>

    </div>

</body>