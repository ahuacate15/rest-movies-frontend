function returnMoviesAjax(detail) {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/returned',
            type : 'POST',
            data : {
                detail : detail
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

function getReturnedMoviesAjax() {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/returned/user',
            type : 'GET',
            headers : {
                'Authorization' : 'Bearer ' + jwt
            },
            success :function(data) {
                resolve(data);
            },
            error: function(xhr) {
                reject(xhr);
            }
        });
    });
}
