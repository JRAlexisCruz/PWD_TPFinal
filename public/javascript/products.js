$(document).ready(function () {
    let filteredProducts = [...allProducts]; // Productos a mostrar, inicialmente todos

    // Renderizar productos iniciales
    renderProducts(filteredProducts);

    // Manejar cambios en filtros y búsqueda
    $('#product-type').change(filterProducts);
    $('#sort-price').change(sortProducts);
    $('#product-search').on('input', filterProducts);

    // Filtrar productos
    function filterProducts() {
        const type = $('#product-type').val();
        const search = $('#product-search').val().toLowerCase();

        filteredProducts = allProducts.filter(product => {
            const matchesType = type === 'all' || product.tipoproducto === type;
            const matchesSearch = product.pronombre.toLowerCase().includes(search);
            return matchesType && matchesSearch;
        });

        renderProducts(filteredProducts);
    }

    // Ordenar productos
    function sortProducts() {
        const sortType = $('#sort-price').val();

        if (sortType === 'asc') {
            filteredProducts.sort((a, b) => a.precioproducto - b.precioproducto);
        } else if (sortType === 'desc') {
            filteredProducts.sort((a, b) => b.precioproducto - a.precioproducto);
        }

        renderProducts(filteredProducts);
    }


    // Renderizar productos (sin paginación)
    function renderProducts(products) {
        const productList = $('#product-list');
        productList.empty();

        if (products.length > 0) {
            products.forEach(product => {
                const productCard = `
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 card-hover">
              <!-- Imagen del producto -->
              <img src="images/${product.proimagen}.jpg" class="card-img-top" alt="${product.pronombre}">
              
              <div class="card-body">
                <!-- Nombre del producto -->
                <div class="product-name">
                  <h5 class="card-title">${product.pronombre}</h5>
                </div>

                <!-- Precio del producto -->
                <div class="product-price">
                  <p class="card-price">$${Number(product.precioproducto).toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p>
                </div>

                <!-- Descripción acortada -->
                <div class="product-description">
                  <p class="card-text">${product.prodetalle.slice(0, 120)}...</p>
                  <div class="link-ver-detalle">
                    <a href="http://localhost/PWD/PWD_TPFinal/public/products/detail/${product.idproducto}" class="btn btn-link">Ver detalle <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                  </div>
                </div>
              </div>

              <!-- Nueva sección para el botón de agregar al carrito -->
              <div class="card-footer">
                <button class="btn btn-bd-primary w-100 add-to-cart" data-id="${product.idproducto}" data-name="${product.pronombre}" data-price="${product.precioproducto}">
                  Agregar al carrito
                  <i class="fa-solid fa-cart-plus"></i>
                </button>
              </div>
            </div>
          </div>`;
                productList.append(productCard);
            });
        } else {
            productList.html('<p>No se encontraron productos.</p>');
        }
    }


    
     // Función para mostrar un modal con un mensaje
     function showModal(message) {
        const modalBody = $('#messageModalBody');
        modalBody.text(message);

        // Mostrar el modal usando Bootstrap
        const modal = new bootstrap.Modal(document.getElementById('messageModal'));
        modal.show();

        // Cerrar el modal automáticamente después de 2 segundos
        setTimeout(() => {
            modal.hide();
        }, 2000);
    }
    

    // Agregar al carrito
    $('#product-list').on('click', '.add-to-cart', function () {
        const productId = $(this).data('id');
        const quantity = 1; // Por defecto, agregamos 1 producto

        $.ajax({
            url: 'http://localhost/PWD/PWD_TPFinal/public/cart/addToCart',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: quantity
            },
            success: function (response) {
                if (response.success) {
                    showModal('Producto agregado al carrito');
                } else {
                    showModal('Inicie sesión para agregar productos al carrito'); //Hubo un error al agregar el producto
                }
            },
            error: function (xhr) {
                if (xhr.status === 303 || xhr.status === 302) {
                    // Redirigir al usuario a la página de inicio de sesión
                    window.location.href = xhr.getResponseHeader('Location') || '/login';
                } else {
                    showModal('Hubo un error al agregar el producto');
                }
            }
        });
    });

});
