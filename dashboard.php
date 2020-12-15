<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Inicio</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="css/main.css" />
        <script src="js/constant.js" type="text/javascript"></script>
        <script src="js/auth.js" type="text/javascript"></script>
        <script src="js/movie.js" type="text/javascript"></script>
		<script type="text/javascript">
            verifySession();

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
						<li><a href="javascript:logout()">Cerrar sesión</a></li>
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
