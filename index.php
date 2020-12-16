

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Inicio</title>
		<?php include('includes/resources.html'); ?>

        <script src="js/constant.js" type="text/javascript"></script>
        <script src="js/movie.js" type="text/javascript"></script>
		<script src="js/auth.js" type="text/javascript"></script>
		<script type="text/javascript">
			//si la sesion se encuentra activa, envio al dashboard
			verifySessionIsActive();

			$(document).ready(function() {
                let currentPage = 0;


			    getMoviesAjax({ search : '', sortBy : 'title' }).then(data => {
                    currentPage = data.currentPage;
                    $("#pagination").html(data.minCurrentValue + ' - ' + data.maxCurrentValue + ' de ' + data.totalRows);
                    $("#movie-list").html("");
                    $.each(data.listMovies, function(index, value) {
                        var html = generateDivMovie(value);
                        $("#movie-list").append(html);
                    });
			    }).catch(err => {
			        console.log('movies err', err);
			    });

                $("#bSearchMovie").click(function(){
                    var title = $("#tTitle").val();
                    var orderBy = $("#sOrderBy").val();

                    $("#movie-list").html("");
                    getMoviesAjax({ search : title, sortBy : orderBy }).then(data => {
                        $("#pagination").html(data.minCurrentValue + ' - ' + data.maxCurrentValue + ' de ' + data.totalRows);
                        $.each(data.listMovies, function(index, value) {
                            var html = generateDivMovie(value);
                            $("#movie-list").append(html);
                        });
                    }).catch(err => {
                        console.log('movies err', err);
                    });

                });

                $("#bAfter").click(function() {
                    var title = $("#tTitle").val();
                    var orderBy = $("#sOrderBy").val();

                    $("#movie-list").html("");
                    getMoviesAjax({ search : title, sortBy : orderBy, page : ++currentPage }).then(data => {
                        console.log('next data', data);
                        $("#pagination").html(data.minCurrentValue + ' - ' + data.maxCurrentValue + ' de ' + data.totalRows);
                        $.each(data.listMovies, function(index, value) {
                            var html = generateDivMovie(value);
                            $("#movie-list").append(html);
                        });
                    }).catch(err => {
                        console.log('movies err', err);
                    });
                });

                $("#bBefore").click(function() {
                    var title = $("#tTitle").val();
                    var orderBy = $("#sOrderBy").val();

                    $("#movie-list").html("");
                    getMoviesAjax({ search : title, sortBy : orderBy, page : currentPage < 1 ? 0 : --currentPage }).then(data => {
                        console.log('next data', data);
                        $("#pagination").html(data.minCurrentValue + ' - ' + data.maxCurrentValue + ' de ' + data.totalRows);
                        $.each(data.listMovies, function(index, value) {
                            var html = generateDivMovie(value);
                            $("#movie-list").append(html);
                        });
                    }).catch(err => {
                        console.log('movies err', err);
                    });
                });
			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Movies</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php">Iniciar sesion</a></li>
						<li><a href="register.php">Crear cuenta</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<!-- filtros de busqueda -->
			<form class="form-inline" action="/action_page.php">
				<div class="form-group">
					<label for="email">Titulo:</label>
					<input type="text" class="form-control" id="tTitle">
				</div>
				<div class="form-group">
					<label for="email">Ordenar por:</label>
					<select class="form-control" id="sOrderBy">
						<option selected value="title">Titulo</option>
						<option value="likes">Popularidad</option>
					</select>
				</div>
				<button type="button" class="btn btn-default" id="bSearchMovie">Buscar</button>

                <div class="pull-right">
                <span id="pagination"></span>
                <button type="button" class="btn btn-link" id="bBefore">Anterior</button>
                <button type="button" class="btn btn-link" id="bAfter">Siguiente</button>
                </div>
			</form>
			<div class="movie-container" id="movie-list">
			</div>
		</div>
	</body>
</html>
