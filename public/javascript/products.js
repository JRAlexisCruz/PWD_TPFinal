$(document).ready(function () {
    const productsPerPage = 12; // Cantidad de productos por página
    let filteredProducts = [...allProducts]; // Productos a mostrar, inicialmente todos
    let currentPage = 1;

    // Renderizar productos iniciales
    renderProducts(filteredProducts, currentPage);
    createPagination(filteredProducts);

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

        currentPage = 1; // Reiniciar a la primera página
        renderProducts(filteredProducts, currentPage);
        createPagination(filteredProducts);
    }

    // Ordenar productos
    function sortProducts() {
        const sortType = $('#sort-price').val();

        if (sortType === 'asc') {
            filteredProducts.sort((a, b) => a.precioproducto - b.precioproducto);
        } else if (sortType === 'desc') {
            filteredProducts.sort((a, b) => b.precioproducto - a.precioproducto);
        }

        renderProducts(filteredProducts, currentPage);
    }

    // Renderizar productos
    function renderProducts(products, page) {
        const start = (page - 1) * productsPerPage;
        const end = start + productsPerPage;
        const productsToShow = products.slice(start, end);

        const productList = $('#product-list');
        productList.empty();

        if (productsToShow.length > 0) {
            productsToShow.forEach(product => {
                const productCard = `
          <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="card h-100 card-hover"> <!-- Se agrega la clase card-hover aquí -->
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
                <p class="card-text">${product.prodetalle.slice(0, 120)}...</p> <!-- Muestra los primeros 100 caracteres de la descripción -->
                
                <!-- Enlace "Ver detalle" en la esquina inferior izquierda -->
                <div class="link-ver-detalle">
                    <a href="http://localhost/PWD/PWD_TPFinal/public/products/detail/${product.idproducto}" class="btn btn-link">Ver detalle <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                </div>
            </div>
        </div>

        <!-- Nueva sección para el botón de agregar al carrito -->
        <div class="card-footer">
                <a href="#" class="btn btn-bd-primary w-100">Agregar al carrito
                    <i class="fa-solid fa-cart-plus"></i>
                </a>
        </div>    
</div>
                `;
                productList.append(productCard);
            });
        } else {
            productList.html('<p>No se encontraron productos.</p>');
        }
    }

    // Crear paginación
    function createPagination(products) {
        const totalPages = Math.ceil(products.length / productsPerPage);
        const pagination = $('#pagination');
        pagination.empty();

        for (let i = 1; i <= totalPages; i++) {
            const pageItem = `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#">${i}</a>
                </li>
            `;
            pagination.append(pageItem);
        }

        // Manejar clics en paginación
        $('.page-link').click(function (e) {
            e.preventDefault();
            currentPage = parseInt($(this).text());
            renderProducts(filteredProducts, currentPage);
            createPagination(filteredProducts);
        });
    }
});
