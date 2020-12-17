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
    var jwt = localStorage.getItem('jwt');
    var formData = new FormData();
    formData.append('title', data.title);
    formData.append('description', data.description);
    formData.append('rentalPrice', data.rentalPrice);
    formData.append('salesPrice', data.salesPrice);
    formData.append('stock', data.stock);
    formData.append('availability', data.availability);
    formData.append('images', data.images);
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

function updateMovieAjax(data) {
    var jwt = localStorage.getItem('jwt');
    var formData = new FormData();
    formData.append('title', data.title);
    formData.append('description', data.description);
    formData.append('rentalPrice', data.rentalPrice);
    formData.append('salesPrice', data.salesPrice);
    formData.append('stock', data.stock);
    formData.append('availability', data.availability);
    formData.append('images', data.images);

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/' + data.idMovie,
            type : 'PUT',
            data : formData,
            processData : false,
            contentType : false,
            headers : {
                'Authorization' : 'Bearer ' + jwt
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

function deleteMovieAjax(idMovie, role) {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/' + idMovie,
            type : 'DELETE',
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

function likeMovieAjax(idMovie, role) {
    var jwt = localStorage.getItem('jwt');

    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/like/' + idMovie,
            type : 'PUT',
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

function getMovie(idMovie) {
    var jwt = localStorage.getItem('jwt');
    return new Promise((resolve, reject) => {
        $.ajax({
            url : URL_API + '/movie/' + idMovie,
            type : 'GET',
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

function generateDivMovie(value) {
    var role = localStorage.getItem('role');
    var image = value.listMovieImage[0] == null ? '../images/default-movie.png' : value.listMovieImage[0].imageUrl;

    var div =
        `<div class="row">`+
        `    <div class="col-md-2">`+
        `    	<img src="${image}" class="img-thumbnail movie-image">`+
        `    </div>`+
        `    <div class="movie-detail col-md-8">`+
        `    	<div>`+
        `    		<h3 style="display: inline">${value.title}</h3>`+
        `		    <span style="display: inline">- ${value.countLikes} votos</span>`+
        `       </div>`+
        `   <div>` +
        `   <br />`+
        `    		<label style="display: block">Precio de renta: $${value.rentalPrice}</label>`+
        `    		<label style="display: block">Precio de compra: $${value.salesPrice}</label>`+
        `    		<p>${value.description}</p>`+
        `    	</div>`+
        `    </div>`+
        `</div>`;
    return div;
}

function generateDivMovieAuth(value) {
    var role = localStorage.getItem('role');
    var image = value.listMovieImage[0] == null ? '../images/default-movie.png' : value.listMovieImage[0].imageUrl;

    var div =
        `<div class="row">`+
        `    <div class="col-md-2">`+
        `    	<img src="${image}" class="img-thumbnail movie-image">`+
        `    </div>`+
        `    <div class="movie-detail col-md-8">`+
        `    	<div>`+
        `    		<h3 style="display: inline">${value.title}</h3>`+
        `		    <span style="display: inline">- ${value.countLikes} votos</span>`+
        `           <ul class="nav navbar-nav pull-right">` +
        `               <li class="dropdown" class="pull-right">` +
        `                   <a id="menu-movie-${value.idMovie}" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">` +
        `                       ${mapCarrito.get(value.idMovie) ? "(1)" : ""} Opciones<span class="caret"></span>`+
        `                   </a>` +
        `                   <ul class="dropdown-menu">` +
        `                       <li>` +
        `                           <button class="btn btn-link" onclick="javascript:addToCart(${value.idMovie})" id="btn-add-cart-${value.idMovie}">`+
        `                               ${mapCarrito.get(value.idMovie) ? "Eliminar del carrito" : "Agregar al carrito"}`+
        `                           </button>`+
        `                       </li>` +
        `                       <li><button class="btn btn-link" onclick="javascript:likeMovie(${value.idMovie})">Marcar favorito</button></li>` +
        `                       <li><button class="btn btn-link" onclick="javascript:openEditMovie(${value.idMovie})">Modificar</a></li>` +
        `                       <li><button class="btn btn-link" onclick="javascript:deleteMovie(${value.idMovie})">Eliminar</button></li>` +
        `                   </ul>` +
        `               </li>` +
        `           </ul>` +
        `       </div>`+
        `   <div>` +
        `   <br />`+
        `    		<label style="display: block">Precio de renta: $${value.rentalPrice}</label>`+
        `    		<label style="display: block">Precio de compra: $${value.salesPrice}</label>`+
        `    		<label style="display: block">Existencias: ${value.stock}</label>`+
        `    		<p>${value.description}</p>`+
        `    	</div>`+
        `    </div>`+
        `</div>`;
    return div;
}

function generateDivMovieCart(value, action) {
    var role = localStorage.getItem('role');
    var image = value.listMovieImage[0] == null ? '../images/default-movie.png' : value.listMovieImage[0].imageUrl;

    var div =
        `<div class="row">`+
        `    <div class="col-md-2">`+
        `    	<img src="${image}" class="img-thumbnail movie-image">`+
        `    </div>`+
        `    <div class="movie-detail col-md-8">`+
        `    	<div>`+
        `    		<h3 style="display: inline">${value.title}</h3>`+
        `       </div>`+
        `   <div>` +
        `   <br />`+
        `    		<label style="display: block">${action == 'rent' ? 'Precio de renta: $' + value.rentalPrice : 'Precio de venta: $' +value.salesPrice}</label>`+
        `    		<p>${value.description}</p>`+
        `    	</div>`+
        `    </div>`+
        `</div>`;
    return div;
}

function generateDivMovieRentOrSales(value, action) {
    var image = value.listImage[0] == null ? '../images/default-movie.png' : value.listImage[0].imageUrl;

    var div =
        `<div class="row" style="margin-top: 15px">`+
        `    <div class="col-md-2">`+
        `    	<img src="${image}" class="img-thumbnail movie-image">`+
        `    </div>`+
        `    <div class="movie-detail col-md-9">`+
        `    	<div>`+
        `    		<h3 style="display: inline">${value.titleMovie}</h3> (${value.returnedDate == null ? "Pendiente" : "Entregada"})`+
        `       </div>`+
        `       <div>` +
        `           <br />`+
        `           <div class="form-group col-md-4">` +
        `       		<label>${action == 'rent' ? 'Precio de renta:' : 'Precio de venta:'}</label>` +
        `               <label class="form-control">$${action == 'rent' ? value.rentalPrice : value.salesPrice}</label>`+
        `           </div>` +
        `           <div class="form-group col-md-4">` +
        `    		    <label>Cantidad:</label>` +
        `               <label class="form-control">${value.quantity}</label>`+
        `           </div>` +
        `           <div class="form-group col-md-4">` +
        `    		    <label>Fecha de renta:</label>` +
        `               <label class="form-control">${value.rentedDate.substring(0, 10)}</label>`+
        `           </div>` +
        `           <div class="form-group col-md-4">` +
        `    		    <label>Fecha estimada de entrega:</label>` +
        `               <label class="form-control">${value.returnDate.substring(0, 10)}</label>`+
        `           </div>` +
        `           <div class="form-group col-md-4">` +
        `    		    <label>Fecha de entrega:</label>` +
        `               <label class="form-control">${value.returnedDate == null ? "-" : value.returnedDate.substring(0, 10)}</label>`+
        `           </div>` +
        `           <div class="form-group col-md-4">` +
        `    		    <label>Penalizacion:</label>` +
        `               <label class="form-control">$${value.amountPenalty == null ? 0 : value.amountPenalty}</label>`+
        `           </div>` +
        //boton de muestra para peliculas pendientes
        (value.returnedDate == null ?
        `           <div class="col-md-4">` +
        `               <button id="btn-return-${value.idMovie}" type="button" class="btn btn-primary btn-block" onclick="returnMovie(${value.idMovie})">Devolver</button>` +
        `           </div>` :
        ``) +
        `    	</div>`+
        `    </div>`+
        `</div>`;
    return div;
}

function readURL(input, output) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $(output).attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
