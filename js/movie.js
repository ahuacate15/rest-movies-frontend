function getMoviesAjax(filters) {
    console.log('dentro de movies');
    return new Promise((resolve, reject) => {
        $.ajax({
            url : 'http://localhost:8080/movie',
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

function generateDivMovie(value) {
    var image = value.listMovieImage[0] == null ? 'images/default-movie.png' : value.listMovieImage[0].imageUrl;

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
