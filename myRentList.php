<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Mis peliculas rentadas</title>
        <?php include ('includes/resources.html')?>
    </head>
    <body>
        <?php include('includes/menu.php'); ?>
        <div class="container">
            <select class="form-control" id="sAction">
                <option selected value="rent">Peliculas pendientes a devolver</option>
                <option value="returned">Peliculas devueltas</option>
            </select>
            <div id="rent-list"></div>
        </div>
    </body>

    <script src="js/constant.js" type="text/javascript"></script>
    <script src="js/auth.js" type="text/javascript"></script>
    <script src="js/rent.js" type="text/javascript"></script>
    <script src="js/movie.js" type="text/javascript"></script>
    <script src="js/return.js" type="text/javascript"></script>
    <script type="text/javascript">
        verifySession();

        function returnMovie(idMovie) {
            $("#btn-return-" + idMovie).html("Procesando...");
            $("#btn-return-" + idMovie).attr('disabled', 'disabled');
            returnMoviesAjax(idMovie)
                .then(data => {
                    getRentedMovies();
                    console.log('ok', data);
                }).catch(err => {
                    console.log('err', err);
                });
        }

        function getRentedMovies() {
            getRentedMoviesAjax()
                .then(data => {
                    $("#rent-list").html("");
                    $.each(data, function(index, value) {
                        var html = generateDivMovieRentOrSales(value, "rent");
                        $("#rent-list").append(html);
                    });
                }).catch(err => {
                    console.log('err', err);
                })
        }

        function getReturnedMovies() {
            getReturnedMoviesAjax()
                .then(data => {
                    $("#rent-list").html("");

                    $.each(data, function(index, value) {
                        var html = generateDivMovieRentOrSales(value, "rent");
                        $("#rent-list").append(html);
                    });
                }).catch(err => {
                    console.log('err', err);
                })
        }

        $(document).ready(function(){
            getRentedMovies();

            $("#sAction").change(function() {
                var val = $(this).val();
                if(val == "rent") {
                    getRentedMovies();
                } else {
                    getReturnedMovies();
                }
            });
        });
    </script>
</html>
