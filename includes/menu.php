<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard.php" id="user-name">Movies</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="javascript:logout()">Cerrar sesión</a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rentas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="myRentList.php">Mis peliculas rentadas</a></li>
                        <li><a href="mySoldList.php">Mis peliculas compradas</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav" id="menu-movies">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Peliculas <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="addMovie.php">Agregar nueva</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav" id="menu-user">
                <li><a href="changeUser.php">Usuarios</a></li>
            </ul>
        </div>
    </div>
</nav>
