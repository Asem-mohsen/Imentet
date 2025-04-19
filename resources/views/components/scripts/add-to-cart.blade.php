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

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');

                fetch("{{ route('imentet.cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        shop_item_id: productId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        toastr.success(data.message);

                        // Update cart count in the navbar
                        updateCartCount(data.cartCount);
                    } else {
                        toastr.error(data.message);
                    }
                })
                .catch(error => {
                    toastr.error("Something went wrong!");
                    console.error(error);
                });
            });
        });

        function updateCartCount(count) {
            const cartCountEl = document.querySelector('#cart-count');
            if (cartCountEl) {
                cartCountEl.innerText = count;
                cartCountEl.style.display = count > 0 ? 'flex' : 'none';
                cartCountEl.classList.add('cart-updated');
                setTimeout(() => cartCountEl.classList.remove('cart-updated'), 300);
            }
        }
    });
</script>