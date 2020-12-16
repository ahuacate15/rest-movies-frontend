function getMoviesAjax(filters) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie',
            data : `search=${filters.search}&sortBy=${filters.sortBy}&page=${filters.page == null ? 0 : filters.page}` ,
            success: function(data) {
                resolve(data);
            },
            error: function(xhr) {
                reject(xhr);
            }
        });
    });
}

function saveMovieAjax(data) {
    console.log('dentro de ajax');
    console.log('antes de jwt');
    var jwt = localStorage.getItem('jwt');
    console.log('despues de jwt');
    var formData = new FormData();
    formData.append('title', data.title);
    formData.append('description', data.description);
    formData.append('rentalPrice', data.rentalPrice);
    formData.append('salesPrice', data.salesPrice);
    formData.append('stock', data.stock);
    formData.append('availability', data.availability);
    formData.append('images', data.images);

    console.log('despues de serializar');

    return new Promise((resolve, reject) => {
        $.ajax({
           url : URL_API + '/movie',
           type : 'POST',
           data : formData,
           processData: false,
           contentType: false,
           headers: {
               'Authorization':'Bearer ' + jwt
           },
           success : function(data) {
               resolve(data);
           },
           error: function(xhr) {
               reject(xhr);
           }
        });
    });
}

function generateDivMovie(value) {
    var image = value.listMovieImage[0] == null ? '../images/default-movie.png' : value.listMovieImage[0].imageUrl;

    var div =
        `<div class="row">`+
        `    <div class="col-md-2">`+
        `    	<img src="${image}" class="img-thumbnail movie-image">`+
        `    </div>`+
        `    <div class="movie-detail col-md-6">`+
        `    	<div>`+
        `    		<h3 style="display: inline">${value.title}</h3>`+
        `		<span style="display: inline">- ${value.countLikes} votos</span>`+
        `    	</div>`+
        `    	<div>` +
        `    		<br />`+
        `    		<label style="display: block">Precio de renta: $${value.rentalPrice}</label>`+
        `    		<label style="display: block">Precio de compra: $${value.salesPrice}</label>`+
        `    		<p>${value.description}</p>`+
        `    	</div>`+
        `    </div>`+
        `</div>`;
    return div;
}
