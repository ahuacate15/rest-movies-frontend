<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard.php">Movies</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:logout()">Cerrar sesión</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rentas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Mis peliculas rentadas</a></li>
                        <li><a href="#">Mis peliculas compradas</a></li>
                        <li><a href="#">Mis devoluciones pendientes</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Peliculas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="addMovie.php">Agregar nueva</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
