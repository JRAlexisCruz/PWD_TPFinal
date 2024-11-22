document.addEventListener('DOMContentLoaded', function () {
  const overlay = document.getElementById('fullpage-loader');

  // Actualizar cantidad
  document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function () {
      const id = this.dataset.id;
      let quantity = parseInt(this.value, 10);
      const min = parseInt(this.getAttribute('min'), 10);
      const max = parseInt(this.getAttribute('max'), 10);

      // Validar que la cantidad esté dentro del rango permitido
      if (quantity < min) quantity = min;
      if (quantity > max) quantity = max;

      this.value = quantity;
      updateCart(id, quantity, this);
    });
  });

  // Función para actualizar el carrito
  function updateCart(productId, quantity, inputElement) {
    const row = inputElement.closest('tr');
    const unitPriceText = row.querySelector('.unit-price').innerText.replace('$', '').replace('.', '').replace(',', '.');
    const unitPrice = parseFloat(unitPriceText);
    const totalPriceElement = row.querySelector('.item-total');

    // Mostrar un loader específico en la fila
    const loader = document.createElement('div');
    loader.className = 'product-loader';
    loader.style.position = 'absolute';
    loader.style.top = '50%';
    loader.style.left = '50%';
    loader.style.transform = 'translate(-50%, -50%)';
    loader.innerHTML = `
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
      </div>`;
    row.style.position = 'relative'; // Asegurar que el contenedor tenga posición relativa
    row.appendChild(loader);

    // Calcular el precio total por producto
    if (!isNaN(unitPrice)) {
      const totalPrice = unitPrice * quantity;
      totalPriceElement.innerText = `${totalPrice.toFixed(2).replace('.', ',')}`;
      updateCartTotal(); // Actualizar el total general
    }

    // Llamada AJAX para actualizar el carrito
    $.ajax({
      url: 'http://localhost/PWD/PWD_TPFinal/public/cart/updateQuantity',
      type: 'POST',
      data: {
        cart_item_id: productId,
        quantity: quantity
      },
      success: function (response) {
        if (!response.success) {
          console.error('Error al actualizar la cantidad');
        }
      },
      error: function () {
        console.error('Error en la solicitud AJAX');
      },
      complete: function () {
        loader.remove(); // Quitar el loader después de completar la solicitud
      }
    });
  }

  // Función para actualizar el total del carrito
  function updateCartTotal() {
    let cartTotal = 0;

    document.querySelectorAll('.item-total').forEach(totalElement => {
      const totalPriceText = totalElement.innerText.replace('$', '').replace('.', '').replace(',', '.');
      const totalPrice = parseFloat(totalPriceText);

      if (!isNaN(totalPrice)) {
        cartTotal += totalPrice;
      }
    });

    document.getElementById('cart-total').innerText = `${cartTotal.toFixed(2).replace('.', ',')}`;
  }

  // Función para confirmar la compra
  document.getElementById('modal-confirm').addEventListener('click', function () {
    overlay.querySelector('.loader-container p').innerText = 'Procesando la compra, aguarde por favor...';
    overlay.classList.remove('d-none'); // Mostrar el loader de pantalla completa

    // Hacer la solicitud AJAX para confirmar la compra
    $.ajax({
      url: 'http://localhost/PWD/PWD_TPFinal/public/cart/confirmPurchase',
      method: 'POST',
      success: function (data) {
        overlay.classList.add('d-none'); // Ocultar el loader
        if (data.success) {
          window.location.href = 'http://localhost/PWD/PWD_TPFinal/public/perfil/compras'; // Redirigir a "mis compras"
        } else {
          console.error(data.error || 'No se pudo confirmar la compra');
        }
      },
      error: function () {
        overlay.classList.add('d-none'); // Ocultar el loader
        console.error('Hubo un error al confirmar la compra');
      }
    });
  });
});
