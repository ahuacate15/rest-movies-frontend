function getUsersAjax() {
    var jwt = localStorage.getItem('jwt');
    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/user',
            method : 'GET',
            headers: {
                'Authorization':'Bearer ' + jwt
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

function changeRole(idUser, role) {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/user/role/' + idUser,
            type : 'PUT',
            data : {
                role : role
            },
            headers: {
                'Authorization':'Bearer ' + jwt
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
