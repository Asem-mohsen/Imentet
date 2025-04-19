<script>
    function toggleQuantities() {
        let selectedOptions = document.getElementById('categorySelect').selectedOptions;
        let quantitiesContainer = document.getElementById('quantitiesContainer');
  
        // Hide all quantity inputs initially
        document.querySelectorAll('.category-quantity').forEach(el => el.style.display = 'none');
  
        if (selectedOptions.length > 0) {
            quantitiesContainer.style.display = 'block';
  
            for (let option of selectedOptions) {
                let categorySlug = option.value.replace(/\s+/g, '-').toLowerCase();
                let quantityDiv = document.getElementById('category-' + categorySlug);
                if (quantityDiv) quantityDiv.style.display = 'block';
            }
        } else {
            quantitiesContainer.style.display = 'none';
        }
    }
  
    function subTotal() {
        let total = 0;
        document.querySelectorAll('.Quantity').forEach(input => {
            let quantity = parseInt(input.value) || 0;
            let price = parseFloat(input.getAttribute('data-price')) || 0;
            total += quantity * price;
        });
  
        document.getElementById('TotalPrice').innerText = total.toFixed(2);
    }
  
</script>