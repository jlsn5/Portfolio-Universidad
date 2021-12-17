<body>
    <header>
        <h1>Picturefy</h1>
    </header>

    <nav class="menu">
        <label for="chkMenu"><span class="icon-menu"></span></label>
        <!-- No sale el icono -->
        <input type="checkbox" id="chkMenu">
        <ul>
            <li><a href="../php/index.php" class="enlace">Inicio</a></li>
            <li><a href="../php/registro.php" class="enlace">Registro</a></li>
            <li><a href="../php/busqueda.php" class="enlace">Busqueda</a></li>
            <li>
                <form action="../php/resultadoBusqueda.php" method="GET">
                    <label for="brapida">Búsqueda rápida:</label>
                    <input type="search" id="brapida" name="brapida" placeholder="España...">
                </form>
            </li>
        </ul>
    </nav>