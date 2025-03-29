<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
        function updateCartCount(count) {
            const cartCountEl = document.querySelector('#cart-count');
            if (cartCountEl) {
                cartCountEl.innerText = count;
                cartCountEl.style.display = count > 0 ? 'inline-block' : 'none';
                cartCountEl.classList.add('cart-updated');
                setTimeout(() => cartCountEl.classList.remove('cart-updated'), 300);
            }
        }
    
        function handleAddToCart() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
    
                    let productId = this.getAttribute('data-id');
                    let quantityInput = this.closest('.product-one__single')?.querySelector('.product-quantity');
                    let quantity = quantityInput ? quantityInput.value : 1;
    
                    let formData = new FormData();
                    formData.append('shop_item_id', productId);
                    formData.append('quantity', quantity);
    
                    fetch('/GEM/cart/add', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(async (response) => {
                        if (!response.ok) {
                            const err = await response.json();
                            throw new Error(err.message || 'Something went wrong!');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            toastr.success(data.message);
                            updateCartCount(data.cartCount);
                        } else {
                            toastr.error(data.message);
                        }
                    })
                    .catch(err => {
                        toastr.error(err.message || 'Something went wrong!');
                    });
                });
            });
        }
    
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
                            const cartCountEl = document.querySelector('#cart-count');
                            if (cartCountEl) {
                                cartCountEl.innerText = data.cartCount;
                                cartCountEl.style.display = data.cartCount > 0 ? 'inline-block' : 'none';
                            }

                            // Update item count in cart page
                            const cartItemsCountEl = document.querySelector('#cart-items-count');
                            if (cartItemsCountEl) {
                                cartItemsCountEl.innerText = `${data.cartCount} item${data.cartCount !== 1 ? 's' : ''}`;
                            }

                            // Update total price
                            const totalPriceEl = document.querySelector('#total-price');
                            if (totalPriceEl) {
                                totalPriceEl.innerText = `${data.totalPrice} EGP`;
                            }

                            // If cart is now empty, show a message
                            if (data.cartCount === 0) {
                                const cartTable = document.querySelector('#cart-table');
                                if (cartTable) {
                                    cartTable.innerHTML = '<tr><td colspan="5" class="text-center">Your cart is empty.</td></tr>';
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

        handleAddToCart();
        handleRemoveFromCart();
    });
</script>
    
<style>
    .cart-updated {
        animation: pulse 0.3s ease-in-out;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }
</style>
    