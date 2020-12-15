<!DOCTYPE html>
<html>
    <head>
        <title>Registrate</title>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    </head>
    <body>
        <div class="row justify-content-center" style="margin-top: 30px;">
            <form class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="form">
                <div class="text-center">
                    <h5 style="margin-top: 20px;">
                        Creacion de cuenta
                    </h5>
                </div>
                <div class="alert alert-warning" role="alert" id="message" style="display: none;"></div>
                <div class="card" style="margin-top: 15px;">
                    <div class="card-body" id="div-fields">
                        <div>
                            <b style="font-size: 14px !important;">Nombre de usuario</b>
                            <input type="text" class="form-control" id="tUserName" />
                        </div>
                        <div style="margin-top: 15px">
                            <b style="font-size: 14px !important;">Correo electrónico</b>
                            <input type="text" class="form-control" id="tEmail" />
                        </div>
                        <div style="margin-top: 15px;">
                            <b style="font-size: 14px !important;">Contraseña</b>
                            <input type="password" class="form-control" id="tPassword" />
                        </div>

                        <div style="margin-top: 15px; ">
                            <button type="button" class="btn btn-primary btn-block" onclick="register()">Entrar</button>
                            <a class="btn btn-link btn-block" href="index.php" style="text-align: center">Regresar al inicio</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script src="js/constant.js" type="text/javascript"></script>
    <script src="js/auth.js" type="text/javascript"></script>
    <script>
        function register() {
            var userName = $("#tUserName").val();
            var email = $("#tEmail").val();
            var password = $("#tPassword").val();

            registerAjax({
                userName : userName,
                email : email,
                password : password
            }).then(data => {
                $("#message").removeClass("alert-warning");
                $("#message").addClass("alert-success");
                $("#message").css("display", "block");
                $("#message").html("Gracias por registrarte, hemos enviado las instrucciones finales a tu correo electronico.");
            }).catch(err => {
                $("#message").addClass("alert-warning");
                $("#message").removeClass("alert-success");
                $("#message").css("display", "block");
                console.log(err);
                if(err.responseJSON != null && err.responseJSON.message != null) {
                    $("#message").html(err.responseJSON.message);
                } else {
                    $("#message").html("Error al iniciar sesión");
                }
            });



        }
    </script>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</html>
