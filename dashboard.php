<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Inicio</title>
		<?php include ('includes/resources.html')?>
	</head>
	<body>
		<?php include('includes/menu.php'); ?>
		<div class="container">
			<!-- filtros de busqueda -->
			<div class="form-inline">
				<div class="form-group">
					<label for="email">Titulo:</label>
					<input type="text" class="form-control" id="tTitle">
				</div>
				<div class="form-group" style="margin-left: 15px">
					<label for="email">Ordenar por:</label>
					<select class="form-control" id="sOrderBy">
						<option selected value="title">Titulo</option>
						<option value="likes">Popularidad</option>
					</select>
				</div>
				<button type="button" class="btn btn-default" id="bSearchMovie">Buscar</button>
				<a href="cart.php" class="btn btn-link" id="lCarrito">Ir al carrito (0)</a>
                <div class="pull-right">
                <span id="pagination"></span>
                <button type="button" class="btn btn-link" id="bBefore">Anterior</button>
                <button type="button" class="btn btn-link" id="bAfter">Siguiente</button>
                </div>
			</div>
			<div class="movie-container" id="movie-list"></div>
		</div>
	</body>


	<script src="js/constant.js" type="text/javascript"></script>
	<script src="js/auth.js" type="text/javascript"></script>
	<script src="js/movie.js" type="text/javascript"></script>
	<script type="text/javascript">
		verifySession();

		var mapCarrito = new Map();
		var listMoviesCarrito = [];
		var listMovies = new Map();

		function addToCart(idMovie) {

			if(mapCarrito.get(idMovie)) {
				mapCarrito.delete(idMovie);
				$("#menu-movie-" + idMovie).html('Opciones <span class="caret"></span>');
				$("#btn-add-cart-" + idMovie).html("Agregar al carrito");
			} else {
				listMoviesCarrito.push(listMovies.get(idMovie));
				mapCarrito.set(idMovie, listMovies.get(idMovie));
				$("#menu-movie-" + idMovie).html('(1) Opciones <span class="caret"></span>');
				$("#btn-add-cart-" + idMovie).html("Eliminar al carrito");
			}

			$("#lCarrito").html("Ir al carrito ("+ mapCarrito.size +")");
			localStorage.setItem('listCarrito', JSON.stringify(listMoviesCarrito));
		}

		function likeMovie(idMovie) {
			$("#menu-movie-" + idMovie).html("Procesando...");
			likeMovieAjax(idMovie)
				.then(data => {

					loadDefaultSearch();
				}).catch(err => {
					console.log('err', err);
				});
		}

		function deleteMovie(idMovie) {
			$("#menu-movie-" + idMovie).html("Eliminando...");
			deleteMovieAjax(idMovie)
			.then(data => {

				loadDefaultSearch();
			}).catch(err => {
				console.log('err', err);
			});
		}

		function openEditMovie(idMovie) {
			location.href = "editMovie.php?idMovie=" + idMovie;
		}

		function loadDefaultSearch() {
			getMoviesAjax({ search : '', sortBy : 'title' }).then(data => {
				currentPage = data.currentPage;
				$("#pagination").html(data.minCurrentValue + ' - ' + data.maxCurrentValue + ' de ' + data.totalRows);
				$("#movie-list").html("");
				$.each(data.listMovies, function(index, value) {
					var html = generateDivMovieAuth(value);
					$("#movie-list").append(html);
					listMovies.set(value.idMovie, value);
				});
			}).catch(err => {
				console.log('movies err', err);
			});
		}
		$(document).ready(function() {
			let currentPage = 0;

			loadDefaultSearch();

			$("#bSearchMovie").click(function(){
				var title = $("#tTitle").val();
				var orderBy = $("#sOrderBy").val();

				$("#movie-list").html("");
				getMoviesAjax({ search : title, sortBy : orderBy }).then(data => {
					$("#pagination").html(data.minCurrentValue + ' - ' + data.maxCurrentValue + ' de ' + data.totalRows);
					$.each(data.listMovies, function(index, value) {
						var html = generateDivMovieAuth(value);
						$("#movie-list").append(html);
						listMovies.set(value.idMovie, value);
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
						var html = generateDivMovieAuth(value);
						$("#movie-list").append(html);
						listMovies.set(value.idMovie, value);
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
						var html = generateDivMovieAuth(value);
						$("#movie-list").append(html);
					});
				}).catch(err => {
					console.log('movies err', err);
				});
			});
		});
	</script>
</html>
