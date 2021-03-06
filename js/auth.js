function authUserAjax(data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/auth',
            method : 'POST',
            data : {
                userName : data.userName,
                password : data.password
            },
            success: function(data) {
                resolve(data);
            },
            error: function(xhr) {
                reject(xhr);
            }
        });
    });
}

function logout() {
    localStorage.clear();
    location.href = "index.php";
}

function verifySession() {
    if(localStorage.getItem('jwt') == null) {
        location.href = "index.php";
    } else {
        var userName = localStorage.getItem('userName');
        var role = localStorage.getItem('role');
        $("#user-name").html("@" +userName);

        if(role != 'ADMIN') {
            $("#menu-movies").remove();
            $("#menu-user").remove();
        }
    }
}

function verifySessionIsActive() {
    if(localStorage.getItem('jwt') != null) {
        location.href = "dashboard.php";
    }
}

function registerAjax(data) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/user',
            method : "POST",
            data : {
                userName : data.userName,
                email : data.email,
                password : data.password
            },
            success: function(data) {
                resolve(data);
            },
            error: function(xhr) {
                reject(xhr);
            }
        });
    });
}
