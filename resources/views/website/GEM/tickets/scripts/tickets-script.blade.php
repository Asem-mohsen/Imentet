<script>
    document.addEventListener("DOMContentLoaded", function () {
        function updateSubTotals() {
            let totalEgyptian = 0;
            let totalForeign = 0;
    
            // Update Egyptian ticket subtotals
            document.querySelectorAll("#egyptian tbody tr").forEach(row => {
                let priceElement = row.querySelector(".price");
                let price = priceElement ? parseFloat(priceElement.textContent.replace(" EGP", "")) : 0;
                let quantityInput = row.querySelector(".Quantity");
                let quantity = quantityInput ? parseInt(quantityInput.value) || 0 : 0;
                let subTotal = price * quantity;
    
                // Update subtotal for this row
                let subTotalElement = row.querySelector(".SubTotal");
                if (subTotalElement) {
                    subTotalElement.textContent = subTotal.toFixed(2) + " EGP";
                }
    
                totalEgyptian += subTotal;
            });
    
            // Update Foreigner ticket subtotals
            document.querySelectorAll("#other tbody tr").forEach(row => {
                let priceElement = row.querySelector(".price");
                let price = priceElement ? parseFloat(priceElement.textContent.replace(" EGP", "")) : 0;
                let quantityInput = row.querySelector(".Quantity");
                let quantity = quantityInput ? parseInt(quantityInput.value) || 0 : 0;
                let subTotal = price * quantity;
    
                // Update subtotal for this row
                let subTotalElement = row.querySelector(".SubTotal");
                if (subTotalElement) {
                    subTotalElement.textContent = subTotal.toFixed(2) + " EGP";
                }
    
                totalForeign += subTotal;
            });
    
            // Update total prices
            document.querySelectorAll(".GrandTotal").forEach(element => {
                element.textContent = (totalEgyptian + totalForeign).toFixed(2) + " EGP";
            });
        }
    
        // Attach event listeners for quantity inputs
        document.querySelectorAll(".Quantity").forEach(input => {
            input.addEventListener("input", updateSubTotals);
            input.addEventListener("change", updateSubTotals);
        });
    
        // Run once on page load to initialize
        updateSubTotals();
    });

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("ticketForm");

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        toastr.success(data.message);
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    });

</script>
    
    