<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Carrito de peliculas</title>
        <?php include ('includes/resources.html')?>
    </head>
    <body>
        <?php include('includes/menu.php'); ?>
        <div class="container">

            <!-- action menu -->
            <div class="alert alert-warning" role="alert" id="message" style="display: none;"></div>
            <div class="form-inline">
                <div class="form-group">
                    <label>Acción</label>
                    <select class="form-control" id="sAction">
                        <option selected value="rent">Renta de peliculas</option>
                        <option value="sales">Compra de peliculas</option>
                    </select>
                    <button id="bFinalize" type="button" class="btn btn-default" onclick="finalize()">Finalizar</button>
                </div>
            </div>

            <!-- content -->
            <h3 id="lTotal">Total: $25.00</h3>
            <div id="cart-content" style="margin-top: 30px"></div>
        </div>
    </body>

    <script src="js/constant.js" type="text/javascript"></script>
	<script src="js/auth.js" type="text/javascript"></script>
	<script src="js/movie.js" type="text/javascript"></script>
    <script src="js/rent.js" type="text/javascript"></script>
    <script src="js/sold.js" type="text/javascript"></script>
	<script type="text/javascript">
        verifySession();

        function loadItems() {
            var sList = localStorage.getItem('listCarrito');
            var list = JSON.parse(sList);
            var total = 0;
            var action = $("#sAction").val();
            $("#cart-content").html("");
            $.each(list, function(index, value) {
                total += action == "rent" ? value.rentalPrice : value.salesPrice;
                var html = generateDivMovieCart(value, action);
                $("#cart-content").append(html);
            });

            $("#lTotal").html("Total: $" + total);
        }

        function finalize() {

            $("#bFinalize").html("Procesando...");

            var sList = localStorage.getItem('listCarrito');
            var list = JSON.parse(sList);
            var listId = [];

            $.each(list, function(index, value) {
                listId.push(value.idMovie);
            });

            if(listId.length == 0) {
                $("#message").addClass("alert-warning");
                $("#message").removeClass("alert-success");
                $("#message").css("display", "block");
                $("#message").html("Debes agregar items");
                $("#bFinalize").html("Finalizar");
                return;
            }

            var action = $("#sAction").val();

            if(action == "rent") {
                rentMoviesAjax(listId.join(","))
                    .then(data => {
                        $("#message").removeClass("alert-warning");
                        $("#message").addClass("alert-success");
                        $("#message").css("display", "block");
                        $("#message").html("Pedido realizado correctamente");
                        $("#bFinalize").html("Finalizar");
                        localStorage.setItem('listCarrito', JSON.stringify({}));
                        loadItems();
                    }).catch(err => {
                        $("#message").addClass("alert-warning");
                        $("#message").removeClass("alert-success");
                        $("#message").css("display", "block");
                        $("#message").html("Error al realizar pedido");
                        $("#bFinalize").html("Finalizar");
                        console.log('fracaso', err);
                    });
            } else {
                soldMoviesAjax(listId.join(","))
                    .then(data => {
                        $("#message").removeClass("alert-warning");
                        $("#message").addClass("alert-success");
                        $("#message").css("display", "block");
                        $("#message").html("Compra realizada correctamente");
                        $("#bFinalize").html("Finalizar");
                        localStorage.setItem('listCarrito', JSON.stringify({}));
                        loadItems();
                    }).catch(err => {
                        $("#message").addClass("alert-warning");
                        $("#message").removeClass("alert-success");
                        $("#message").css("display", "block");
                        $("#message").html("Error al realizar venta");
                        $("#bFinalize").html("Finalizar");
                        console.log('fracaso', err);
                    });
            }

        }

        $(document).ready(function(){
            loadItems();

            $("#sAction").change(function() {
                loadItems();
            });
        });
    </script>
</html>
