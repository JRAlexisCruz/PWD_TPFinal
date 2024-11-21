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

  function updateCart(productId, quantity, inputElement) {
    const row = inputElement.closest('tr');
    const unitPrice = parseFloat(row.querySelector('.text-center').innerText.replace('$', '').replace(',', '.'));
    const totalPriceElement = row.querySelector('.item-total');

    // Actualizar el precio total del producto
    const totalPrice = unitPrice * quantity;
    totalPriceElement.innerText = `$${totalPrice.toFixed(2).replace('.', ',')}`;

    // Actualizar el total general del carrito
    updateCartTotal();
  }

  function updateCartTotal() {
    let cartTotal = 0;

    document.querySelectorAll('.item-total').forEach(totalElement => {
      const totalPrice = parseFloat(totalElement.innerText.replace('$', '').replace(',', '.'));
      cartTotal += totalPrice;
    });

    document.getElementById('cart-total').innerText = `$${cartTotal.toFixed(2).replace('.', ',')}`;
  }
});
