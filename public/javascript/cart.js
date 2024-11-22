document.addEventListener('DOMContentLoaded', function () {
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

  // Botones para aumentar y disminuir cantidad
  document.querySelectorAll('.increase-quantity').forEach(btn => {
    btn.addEventListener('click', function () {
      const input = this.parentElement.querySelector('.quantity-input');
      let quantity = parseInt(input.value, 10) || 1;
      const max = parseInt(input.getAttribute('max'), 10);
      if (quantity < max) {
        input.value = quantity + 1;
        input.dispatchEvent(new Event('change'));
      }
    });
  });

  document.querySelectorAll('.decrease-quantity').forEach(btn => {
    btn.addEventListener('click', function () {
      const input = this.parentElement.querySelector('.quantity-input');
      let quantity = parseInt(input.value, 10) || 1;
      if (quantity > 1) {
        input.value = quantity - 1;
        input.dispatchEvent(new Event('change'));
      }
    });
  });

  // Función para actualizar el carrito
  function updateCart(productId, quantity, inputElement) {
    const row = inputElement.closest('tr');
    const unitPriceText = row.querySelector('.unit-price').innerText.replace('$', '').replace('.', '').replace(',', '.');
    const unitPrice = parseFloat(unitPriceText);
    const totalPriceElement = row.querySelector('.item-total');

    // Calcular el precio total por producto
    if (!isNaN(unitPrice)) {
      const totalPrice = unitPrice * quantity;

      // Actualizar el precio total por producto
      totalPriceElement.innerText = `${totalPrice.toFixed(2).replace('.', ',')}`; // No agregar el signo $ aquí

      // Actualizar el total general del carrito
      updateCartTotal();
    }
  }

  // Eliminar producto del carrito
  document.querySelectorAll('.delete-item').forEach(button => {
    button.addEventListener('click', function () {
      const cartItemId = parseInt(this.dataset.id);
      
      // Verificar si el cartItemId está presente
      if (!cartItemId) {
        console.error('cartItemId no encontrado en el botón de eliminación');
        return;
      }

      console.log('ID del producto a eliminar:', cartItemId);
      console.log(typeof(cartItemId));

      // Confirmación de eliminación
      if (confirm('¿Estás seguro de que deseas eliminar este producto del carrito?')) {
        // Hacer la solicitud AJAX para eliminar el producto usando jQuery
        $.ajax({
          url: 'http://localhost/PWD/PWD_TPFinal/public/cart/removeFromCart', // URL de la API
          method: 'POST', // Método HTTP
          contentType: 'application/json', // Tipo de contenido
          data: JSON.stringify({ cartItemId: cartItemId }), // Enviar cartItemId como JSON
          success: function (data) {
            if (data.success) {
              // Eliminar el elemento de la tabla
              button.closest('tr').remove();
              // Actualizar el total del carrito
              updateCartTotal();
              alert('Producto eliminado del carrito');
            } else {
              alert(data.error || 'No se pudo eliminar el producto');
            }
          },
          error: function (error) {
            console.error('Error al eliminar el producto:', error);
            alert('Hubo un error al eliminar el producto');
          }
        });
      }
    });
  });

  // Función para actualizar el total del carrito
  function updateCartTotal() {
    let cartTotal = 0;

    document.querySelectorAll('.item-total').forEach(totalElement => {
      // Asegurarse de eliminar el signo $ antes de hacer las operaciones
      const totalPriceText = totalElement.innerText.replace('$', '').replace('.', '').replace(',', '.');
      const totalPrice = parseFloat(totalPriceText);

      if (!isNaN(totalPrice)) {
        cartTotal += totalPrice;
      }
    });

    document.getElementById('cart-total').innerText = `${cartTotal.toFixed(2).replace('.', ',')}`;
  }

  // Función para confirmar la compra
  document.getElementById('confirm-purchase').addEventListener('click', function () {
    // Confirmar compra
    if (confirm('¿Estás seguro de que deseas confirmar la compra?')) {
      // Hacer la solicitud AJAX para confirmar la compra
      $.ajax({
        url: 'http://localhost/PWD/PWD_TPFinal/public/cart/confirmPurchase', // URL de la API
        method: 'POST', // Método HTTP
        success: function (data) {
          if (data.success) {
            alert('Compra confirmada');
            // Redirigir al usuario a la página de éxito o de resumen
            window.location.href = 'http://localhost/PWD/PWD_TPFinal/public/perfil/compras'; // Ajusta esta URL según sea necesario
          } else {
            alert(data.error || 'No se pudo confirmar la compra');
          }
        },
        error: function (error) {
          console.error('Error al confirmar la compra:', error);
          alert('Hubo un error al confirmar la compra');
        }
      });
    }
  });
});
