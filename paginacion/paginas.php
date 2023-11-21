<nav>
    <div class="row">
        <div class="col-xs-12 col-sm-6">

            <p>Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> productos disponibles</p>
        </div>
        <div class="col-xs-12 col-sm-6">
            <p>Página <?php echo $pagina ?> de <?php echo $cantidad_de_paginas ?> </p>
        </div>
    </div>
    <ul class="pagination">
        <!-- Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
        <?php if ($pagina > 1) { ?>
            <li>
                <a href="./listar.php?pagina=<?php echo $pagina - 1 ?>">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php } ?>

        <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
        <?php for ($x = 1; $x <= $paginas; $x++) { ?>
            <li class="<?php if ($x == $pagina) echo "active" ?>">
                <a href="./listar.php?pagina=<?php echo $x ?>">
                    <?php echo $x ?></a>
            </li>
        <?php } ?>
        <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
        <?php if ($pagina < $cantidad_de_paginas) { ?>
            <li>
                <a href="./listar.php?pagina=<?php echo $pagina + 1 ?>">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>