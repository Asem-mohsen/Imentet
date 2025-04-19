<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Add CSS for cart-updated animation
    const style = document.createElement('style');
    style.textContent = `
        .cart-updated {
            animation: pulse 0.3s ease-in-out;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    `;
    document.head.appendChild(style);

    // Update the cart count (for the cart icon)
    function updateCartCount(count) {
        const cartCountEl = document.querySelector('#cart-count');
        if (cartCountEl) {
            cartCountEl.innerText = count;
            cartCountEl.style.display = count > 0 ? 'flex' : 'none';
            cartCountEl.classList.add('cart-updated');
            setTimeout(() => cartCountEl.classList.remove('cart-updated'), 300);
        }
    }

    // Update subtotal for a row
    function updateSubtotal(row) {
        const price = parseFloat(row.querySelector('.price').innerText) || 0;
        const quantity = parseInt(row.querySelector('.quantity-spinner').value) || 1;
        const subtotal = price * quantity;
        row.querySelector('.sub-total').innerText = subtotal.toFixed(2);
        updateTotalPrice();
    }

    // Update the total price in the cart
    function updateTotalPrice() {
        let totalPrice = 0;

        document.querySelectorAll('#cart-table tr').forEach(row => {
            const rowSubtotal = parseFloat(row.querySelector('.sub-total').innerText) || 0;
            totalPrice += rowSubtotal;
        });

        const totalPriceEl = document.querySelector('#total-price');
        if (totalPriceEl) {
            totalPriceEl.innerText = totalPrice.toFixed(2) + ' EGP';
        }
    }

    // Handle quantity change in cart items (via spinner or input change)
    function handleQuantityChange() {
        // Listen for the input field change event (for manual entry)
        document.querySelectorAll('.quantity-spinner').forEach(input => {
            input.addEventListener('change', function () {
                const row = this.closest('tr');
                updateSubtotal(row);
            });
        });

        // Listen for the "+" and "-" button click events in the spinner
        document.querySelectorAll('.quantity-spinner').forEach(input => {
            const incrementBtn = input.closest('.input-group').querySelector('.bootstrap-touchspin-up');
            const decrementBtn = input.closest('.input-group').querySelector('.bootstrap-touchspin-down');

            if (incrementBtn) {
                incrementBtn.addEventListener('click', function () {
                    let currentValue = parseInt(input.value) || 1;
                    // Increment by 1, ensuring it doesn't exceed the max limit
                    input.value = Math.min(parseInt(input.max), currentValue + 1); 
                    const row = input.closest('tr');
                    updateSubtotal(row);
                });
            }

            if (decrementBtn) {
                decrementBtn.addEventListener('click', function () {
                    let currentValue = parseInt(input.value) || 1;
                    // Decrement by 1, ensuring it doesn't go below the min limit (1)
                    if (currentValue > 1) {
                        input.value = Math.max(parseInt(input.min), currentValue - 1); 
                        const row = input.closest('tr');
                        updateSubtotal(row);
                    }
                });
            }
        });
    }

    // Handle item removal from cart
    function handleRemoveFromCart() {
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function () {
                const url = this.dataset.removeUrl;

                const formData = new FormData();
                formData.append('_method', 'DELETE');

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                })
                .then(async (response) => {
                    if (!response.ok) {
                        const err = await response.json();
                        throw new Error(err.message || 'Failed to remove item.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message);

                        // Remove row from DOM
                        const row = this.closest('tr');
                        if (row) row.remove();

                        // Update cart count in navbar
                        updateCartCount(data.cartCount);

                        // Update item count in cart page
                        const cartItemsCountEl = document.querySelector('#cart-items-count');
                        if (cartItemsCountEl) {
                            cartItemsCountEl.innerText = `${data.cartCount} item${data.cartCount !== 1 ? 's' : ''}`;
                        }

                        // Update total price
                        updateTotalPrice();

                        // If cart is now empty, show a message
                        if (data.cartCount === 0) {
                            const cartTable = document.querySelector('#cart-table');
                            if (cartTable) {
                                cartTable.innerHTML = '<tr><td colspan="5" class="text-center cart-empty">Your cart is empty.</td></tr>';
                            }
                        }
                    } else {
                        toastr.error(data.message);
                    }
                })
                .catch(error => {
                    toastr.error(error.message || 'Something went wrong!');
                });
            });
        });
    }

    // Initialize the functionalities
    handleQuantityChange();
    handleRemoveFromCart();

    // Initialize the subtotals for the existing items
    document.querySelectorAll('#cart-table tr').forEach(row => {
        updateSubtotal(row);
    });
});

</script>