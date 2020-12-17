function rentMoviesAjax(detail) {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/rented',
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

function getRentedMoviesAjax() {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/rented/user',
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

function getRentedMoviesAuthAjax() {}
