<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Modificar pelicula</title>
        <?php include('includes/resources.html'); ?>
        <script src="js/constant.js" type="text/javascript"></script>
        <script src="js/auth.js" type="text/javascript"></script>
        <script src="js/movie.js" type="text/javascript" ></script>
    </head>
    <body>
        <?php include('includes/menu.php'); ?>
        <div class="container">
            <form class="form" id="form-movie">
                <div class="alert alert-warning" role="alert" id="message" style="display: none"></div>
                <h2>Modificar pelicula</h2>
                <div class="col-md-2">
                    <div>
                        <img src="images/default-movie.png" style="width: 100%; height: auto" id="iMovie" />
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" id="tTitle" class="form-control" />
                        <input type="hidden" id="tIdMovie" />
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea class="form-control" id="tDescription"></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Precio de renta</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon" id="sizing-addon1">$</span>
                                <input type="number" id="tRentalPrice" class="form-control" aria-describedby="sizing-addon1">
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Precio de venta</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon" id="sizing-addon1">$</span>
                                <input type="number" id="tSalesPrice" class="form-control" aria-describedby="sizing-addon1">
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Numero de existencias</label>
                            <input type="number" id="tStock" class="form-control" />
                        </div>
                    </div>

                    <div class="checkbox form-group">
                        <label>
                            <input type="checkbox" id="cAvailability" /> pelicula disponible
                        </label>
                    </div>

                    <div class="form-group" style="margin-top: 15px">
                        <label>Imagenes adjuntas</label>
                        <input type="file" id="bImages" class="form-control-file" />
                    </div>

                    <button id="bUpdate" type="button" class="btn btn-primary" onclick="updateMovie()">Guardar cambios</button>
                    <a href="dashboard.php" class="btn btn-link">Regresar</a>
                </div>
            </form>
        </div>
    </body>

    <script type="text/javascript">
        verifySession();
        function updateMovie() {
            $("#bUpdate").html("Procesando...");
            var idMovie = $("#tIdMovie").val();
            var title = $("#tTitle").val();
            var description = $("#tDescription").val();
            var salesPrice = $("#tSalesPrice").val();
            var rentalPrice = $("#tRentalPrice").val();
            var stock = $("#tStock").val();
            var availability = $("#cAvailability").is(':checked');
            var images = $("#bImages")[0].files[0];

            updateMovieAjax({
                idMovie : idMovie,
                title : title,
                description : description,
                salesPrice : salesPrice,
                rentalPrice : rentalPrice,
                stock : stock,
                availability : availability,
                images : images
            }).then(data => {
                $("#message").removeClass("alert-danger");
                $("#message").removeClass("alert-warning");
                $("#message").addClass("alert-success");
                $("#message").css("display", "block");
                $("#message").html("Pelicula actualizada correctamente");
                $("#bUpdate").html("Guardar cambios");
            }).catch(err => {
                console.log('err', err);
                $("#message").addClass("alert-danger");
                $("#message").removeClass("alert-warning");
                $("#message").removeClass("alert-success");
                $("#message").css("display", "block");

                if(err.responseJSON != null && err.responseJSON.message != null && err.responseJSON.message != '') {
                    $("#message").html(err.responseJSON.message);
                } else {
                    $("#message").html("Error al actualizar la pelicula");
                }

                $("#bUpdate").html("Guardar cambios");

            });
        }

        $(document).ready(function() {
            getMovie(<?php echo $_GET['idMovie'] ?>)
                .then(data => {
                    console.log('movie', data);
                    $("#tIdMovie").val(data.idMovie);
                    $("#tTitle").val(data.title);
                    $("#tDescription").val(data.description);
                    $("#tRentalPrice").val(data.rentalPrice);
                    $("#tSalesPrice").val(data.salesPrice);
                    $("#tStock").val(data.stock);
                    $('#cAvailability').prop('checked', data.availability);
                    if(data.listMovieImage.length > 0) {
                        $("#iMovie").attr("src", data.listMovieImage[0].imageUrl);
                    }
                }).catch(err => {
                    console.log('err', err);
                });

            $("#bImages").change(function(){
                readURL(this, '#iMovie');
            });
        });
    </script>
</html>
