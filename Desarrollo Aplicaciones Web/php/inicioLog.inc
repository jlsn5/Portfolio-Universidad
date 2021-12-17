<body>
    <header>
        <h1>Picturefy</h1>
    </header>

    <nav class="menu">
        <label for="chkMenu">X</label>
        <input type="checkbox" id="chkMenu">
        <ul>
            <li><a href="../php/indexlog.php">Inicio</a></li>
            <li><a href="../php/busqueda.php">Busqueda</a></li>
            <li><a href="../php/modificarDatos.php">Modificar mis datos</a></li>
            <li><a href="../php/darseDeBaja.php">Darme de baja</a></li>
            <li><a href="../php/misalbumes.php">Mis álbumes</a></li>
            <li><a href="../php/misfotos.php">Mis Fotos</a></li>
            <li><a href="../php/crearAlbum.php">Crear álbum</a></li>
            <li><a href="../php/solicitar.php">Solicitar álbum</a></li>
            <li><a href="../php/configurar.php">Configurar</a></li>
            <li><a href="../php/controlLogout.php">Cerrar Sesión</a></li>
            <li>
                <form action="../php/resultadoBusqueda.php" method="GET">
                    <label for="brapida">Búsqueda rápida:</label>
                    <input type="search" id="brapida" name="brapida" placeholder="España...">
                </form>
            </li>
            <li><a href="../php/misdatos.php">Mis datos</a></li>
        </ul>
    </nav>