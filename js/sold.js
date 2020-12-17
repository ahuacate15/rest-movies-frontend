function soldMoviesAjax(detail) {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/sold',
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

function getSoldMoviesAjax() {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/sold/user',
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
