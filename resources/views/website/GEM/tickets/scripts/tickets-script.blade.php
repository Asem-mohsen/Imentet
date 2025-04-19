<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add CSS styles for quantity spinner
        const style = document.createElement('style');
        style.textContent = `
            .quantity-spinner {
                text-align: center;
                width: 60px;
            }
        `;
        document.head.appendChild(style);
        
        // Initialize quantity spinners
        initializeQuantitySpinners();
        
        // Initialize phone number editing functionality
        initializePhoneEditing();
        
        // Initialize ticket removal functionality
        initializeTicketRemoval();
        
        function initializeTicketRemoval() {
            // Add event listeners to all remove ticket buttons
            document.querySelectorAll('.remove-ticket-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const ticketId = this.getAttribute('data-ticket-id');
                    removeTicket(ticketId);
                });
            });
        }
        
        function removeTicket(ticketId) {
            if (!ticketId) return;
            
            // Show confirmation dialog
            if (!confirm('Are you sure you want to remove this ticket from your cart?')) {
                return;
            }
            
            // Send AJAX request to remove ticket
            fetch('{{ route("gem.tickets.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ ticket_id: ticketId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the row from the table
                    const row = document.querySelector(`tr[data-ticket-id="${ticketId}"]`);
                    if (row) {
                        row.remove();
                        
                        // Check if there are any tickets left
                        const remainingRows = document.querySelectorAll('.cart-table tbody tr[data-ticket-id]').length;
                        if (remainingRows === 0) {
                            // If no tickets left, show the "No tickets selected" message
                            const tbody = document.querySelector('.cart-table tbody');
                            tbody.innerHTML = '<tr><td colspan="5" style="text-align: center">No tickets selected.</td></tr>';
                            
                            // Update the cart total section
                            const cartTotal = document.querySelector('.cart-total');
                            if (cartTotal) {
                                cartTotal.innerHTML = `
                                    <a href="{{route('gem.tickets.index')}}" class="thm-btn cart-update__btn cart-update__btn-three">
                                        Select Tickets
                                    </a>
                                `;
                            }
                        }
                        
                        // Show success message
                        toastr.success('Ticket removed from cart');
                    }
                } else {
                    toastr.error(data.message || 'Failed to remove ticket from cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('An error occurred while removing the ticket');
            });
        }
        
        function initializePhoneEditing() {
            // Add phone button click handler
            const addPhoneBtn = document.querySelector('.add-phone-btn');
            if (addPhoneBtn) {
                addPhoneBtn.addEventListener('click', function() {
                    showPhoneEditForm();
                });
            }
            
            // Edit phone button click handler
            const editPhoneBtn = document.querySelector('.edit-phone-btn');
            if (editPhoneBtn) {
                editPhoneBtn.addEventListener('click', function() {
                    showPhoneEditForm();
                });
            }
            
            // Save phone button click handler
            const savePhoneBtn = document.querySelector('.save-phone-btn');
            if (savePhoneBtn) {
                savePhoneBtn.addEventListener('click', function() {
                    savePhoneNumber();
                });
            }
            
            // Cancel phone button click handler
            const cancelPhoneBtn = document.querySelector('.cancel-phone-btn');
            if (cancelPhoneBtn) {
                cancelPhoneBtn.addEventListener('click', function() {
                    hidePhoneEditForm();
                });
            }
        }
        
        function showPhoneEditForm() {
            const phoneDisplay = document.getElementById('phone-display');
            const phoneEditForm = document.getElementById('phone-edit-form');
            const addPhoneBtn = document.querySelector('.add-phone-btn');
            const editPhoneBtn = document.querySelector('.edit-phone-btn');
            
            if (phoneDisplay) phoneDisplay.classList.add('d-none');
            if (addPhoneBtn) addPhoneBtn.classList.add('d-none');
            if (editPhoneBtn) editPhoneBtn.classList.add('d-none');
            if (phoneEditForm) phoneEditForm.classList.remove('d-none');
            
            // Focus on the input field
            const phoneInput = document.getElementById('phone-input');
            if (phoneInput) phoneInput.focus();
        }
        
        function hidePhoneEditForm() {
            const phoneDisplay = document.getElementById('phone-display');
            const phoneEditForm = document.getElementById('phone-edit-form');
            const addPhoneBtn = document.querySelector('.add-phone-btn');
            const editPhoneBtn = document.querySelector('.edit-phone-btn');
            
            if (phoneDisplay) phoneDisplay.classList.remove('d-none');
            if (addPhoneBtn) addPhoneBtn.classList.remove('d-none');
            if (editPhoneBtn) editPhoneBtn.classList.remove('d-none');
            if (phoneEditForm) phoneEditForm.classList.add('d-none');
        }
        
        function savePhoneNumber() {
            const phoneInput = document.getElementById('phone-input');
            const phoneDisplay = document.getElementById('phone-display');
            const phoneCell = document.getElementById('phone-cell');
            
            if (!phoneInput || !phoneDisplay) return;
            
            const phoneNumber = phoneInput.value.trim();
            
            if (!phoneNumber) {
                toastr.error('Please enter a valid phone number');
                return;
            }
            
            // Send AJAX request to save phone number
            fetch('{{ route("user.updatePhone") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ phone: phoneNumber })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the display
                    phoneDisplay.textContent = phoneNumber;
                    
                    // If this was the first time adding a phone number, update the UI
                    if (phoneDisplay.textContent === 'No phone number') {
                        // Create edit button if it doesn't exist
                        if (!document.querySelector('.edit-phone-btn')) {
                            const editBtn = document.createElement('button');
                            editBtn.type = 'button';
                            editBtn.className = 'btn btn-sm btn-outline-primary edit-phone-btn';
                            editBtn.setAttribute('data-toggle', 'tooltip');
                            editBtn.setAttribute('title', 'Edit phone number');
                            editBtn.innerHTML = '<i class="fa fa-edit"></i>';
                            editBtn.addEventListener('click', showPhoneEditForm);
                            
                            // Add the button after the phone display
                            phoneDisplay.after(editBtn);
                        }
                    }
                    
                    // Hide the edit form
                    hidePhoneEditForm();
                    
                    // Show success message
                    toastr.success('Phone number updated successfully');
                } else {
                    toastr.error(data.message || 'Failed to update phone number');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('An error occurred while updating your phone number');
            });
        }
        
        function initializeQuantitySpinners() {
            const quantityInputs = document.querySelectorAll(".quantity-spinner");
            
            quantityInputs.forEach(input => {
                // Add input event listener
                input.addEventListener("input", function() {
                    updateSubTotals();
                });
                
                // Add change event listener
                input.addEventListener("change", function() {
                    updateSubTotals();
                });
                
                // Find the up and down buttons for this input
                const parentDiv = input.closest('.bootstrap-touchspin');
                if (parentDiv) {
                    const upButton = parentDiv.querySelector('.bootstrap-touchspin-up');
                    const downButton = parentDiv.querySelector('.bootstrap-touchspin-down');
                    
                    // Add click event listeners to the buttons
                    if (upButton) {
                        upButton.addEventListener('click', function() {
                            setTimeout(updateSubTotals, 10); // Small delay to ensure value is updated
                        });
                    }
                    
                    if (downButton) {
                        downButton.addEventListener('click', function() {
                            setTimeout(updateSubTotals, 10); // Small delay to ensure value is updated
                        });
                    }
                }
            });
        }
        
        function updateSubTotals() {
            let totalEgyptian = 0;
            let totalForeign = 0;
    
            // Update Egyptian ticket subtotals
            document.querySelectorAll("#egyptian tbody tr").forEach(row => {
                let priceElement = row.querySelector(".price");
                let price = priceElement ? parseFloat(priceElement.textContent.replace(" EGP", "")) : 0;
                let quantityInput = row.querySelector(".quantity-spinner");
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
                let quantityInput = row.querySelector(".quantity-spinner");
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
    
        // Run once on page load to initialize
        updateSubTotals();
    });

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("ticketForm");

        form.addEventListener("submit", function (event) {
            event.preventDefault();

            // Validate quantities before submission
            let isValid = true;
            let totalQuantity = 0;
            
            document.querySelectorAll(".quantity-spinner").forEach(input => {
                const value = parseInt(input.value);
                const min = parseInt(input.min);
                const max = parseInt(input.max);
                
                if (isNaN(value) || value < min || value > max) {
                    isValid = false;
                    toastr.error("Please enter valid quantities for all tickets");
                    return;
                }
                
                totalQuantity += value;
            });
            
            if (totalQuantity === 0) {
                isValid = false;
                toastr.error("Please select at least one ticket");
            }
            
            if (!isValid) {
                return;
            }

            // Remove any zero quantity inputs before submitting
            document.querySelectorAll(".quantity-spinner").forEach(input => {
                if (parseInt(input.value) === 0) {
                    // Find and remove the corresponding hidden ticket_id input
                    const ticketIdInput = input.previousElementSibling;
                    if (ticketIdInput && ticketIdInput.name === "ticket_id[]") {
                        ticketIdInput.remove();
                    }
                    // Remove the quantity input itself
                    input.remove();
                }
            });

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
    
    