<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Usuarios registrados</title>
        <?php include('includes/resources.html'); ?>
        <script src="js/constant.js" type="text/javascript"></script>
        <script src="js/auth.js" type="text/javascript"></script>
        <script src="js/user.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include('includes/menu.php'); ?>
        <div class="container">
            <div class="alert alert-warning" role="alert" id="message" style="display: none;"></div>
            <table class="table" id="tbUsers">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </body>
    <script type="text/javascript">
        getUsersAjax()
            .then(data => {
                $("#tbUsers>tbody").html("");

                $.each(data, function(index, value) {
                    var html =
                        `<tr data-id-user="${value.idUser}">` +
                        `   <td>${value.userName}</td>` +
                        `   <td>${value.email}</td>` +
                        `   <td>` +
                        `       <select class="form-control" id="option-${value.idUser}">` +
                        `           <option ${value.role == 'ADMIN' ? 'selected' : ''}>ADMIN</option>` +
                        `           <option ${value.role != 'ADMIN' ? 'selected' : ''}>USER</option>` +
                        `       </select>` +
                        `   </td>` +
                        `   <td>` +
                        `       <button class="btn btn-default" onclick="updateRole(${value.idUser})">Guardar</button>` +
                        `   </td>` +
                        `</tr>`;
                    $("#tbUsers>tbody").append(html);
                });
            }).catch(err => {
                console.log('err', err);
            });

        function updateRole(idUser) {
            var role = $("#option-" + idUser).val();
            changeRole(idUser, role)
                .then(data => {
                    $("#message").removeClass("alert-danger");
                    $("#message").removeClass("alert-warning");
                    $("#message").addClass("alert-success");
                    $("#message").css("display", "block");
                    $("#message").html(data.message);
                }).catch(err => {
                    $("#message").addClass("alert-danger");
                    $("#message").removeClass("alert-warning");
                    $("#message").removeClass("alert-success");
                    $("#message").css("display", "block");

                    if(err.responseJSON != null && err.responseJSON.message != null && err.responseJSON.message != '') {
                        $("#message").html(err.responseJSON.message);
                    } else {
                        $("#message").html("Error al actualizar el rol");
                    }
                });
        }
    </script>
</html>
