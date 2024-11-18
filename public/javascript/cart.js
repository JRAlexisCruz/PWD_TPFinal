/* JS personalizado para botones de cantidad y eliminación --> */

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
          updateCart(id, quantity);
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

      // Eliminar producto
      document.querySelectorAll('.delete-item').forEach(btn => {
        btn.addEventListener('click', function () {
          const id = this.dataset.id;
          removeFromCart(id);
        });
      });

      function updateCart(productId, quantity) {
        // Aquí puedes enviar una solicitud AJAX para actualizar el carrito en el servidor
        console.log(`Actualizar carrito - Producto ID: ${productId}, Nueva cantidad: ${quantity}`);
      }

      function removeFromCart(productId) {
        // Aquí puedes enviar una solicitud AJAX para eliminar el producto del carrito en el servidor
        console.log(`Eliminar producto del carrito - Producto ID: ${productId}`);
      }
    });
