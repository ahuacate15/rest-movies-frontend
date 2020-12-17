<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Mis peliculas compradas</title>
        <?php include ('includes/resources.html')?>
    </head>
    <body>
        <?php include('includes/menu.php'); ?>
        <div class="container">
            <div id="sold-list"></div>
        </div>
    </body>

    <script src="js/constant.js" type="text/javascript"></script>
    <script src="js/auth.js" type="text/javascript"></script>
    <script src="js/movie.js" type="text/javascript"></script>
    <script src="js/sold.js" type="text/javascript"></script>
    <script type="text/javascript">
        verifySession();

        function soldMovie(idMovie) {
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

        function getSoldMovies() {
            getSoldMoviesAjax()
                .then(data => {
                    $("#sold-list").html("");
                    $.each(data, function(index, value) {
                        var html = generateDivMovieSold(value, "rent");
                        $("#sold-list").append(html);
                    });
                }).catch(err => {
                    console.log('err', err);
                })
        }

        function getSoldMovies() {
            getSoldMoviesAjax()
                .then(data => {
                    $("#sold-list").html("");

                    $.each(data, function(index, value) {
                        var html = generateDivMovieSold(value, "rent");
                        $("#sold-list").append(html);
                    });
                }).catch(err => {
                    console.log('err', err);
                })
        }

        $(document).ready(function(){
            getSoldMovies();
        });
    </script>
</html>
