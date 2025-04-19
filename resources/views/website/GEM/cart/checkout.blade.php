@extends('layout.template.gem-template')

@section('title' , 'Checkout')

@section('content')

    <div class="container">
        <ul class="list-unstyled thm-breadcrumb thm-breadcrumb__two">
            <li><a href="{{route('gem.home')}}">Home</a></li>
            <li><a href="{{route('gem.shop.index')}}">Shop</a></li>
            <li><a href="{{route('gem.cart.index')}}">Cart</a></li>
            <li>Checkout</li>
        </ul>
    </div>

    <section class="checkout-page mb-5">
        <div class="container">
            <div class="row mt-5">
                <!-- Order Summary -->
                <div class="col-lg-4 order-lg-2">
                    <div class="cart-total flex-column">
                        <h3 class="cart-total__text text-uppercase mb-4">Order Summary</h3>
                        <div class="cart-total__content">
                            @foreach($cart->items as $item)
                                <div class="d-flex justify-content-between flex-column mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img src="{{ $item->shopItem->getFirstMediaUrl('shop_item') }}" alt="{{ $item->shopItem->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        </div>
                                        <div class="ml-2">
                                            <h5 class="mb-0">{{ $item->shopItem->name }}</h5>
                                            <p class="d-flex text-muted mb-0 justify-content-between mt-1">
                                                <span>x{{ $item->quantity }}</span>
                                                <span>{{ number_format($item->shopItem->price * $item->quantity, 2) }} EGP</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Total:</strong>
                                <strong class="cart-total__highlight">{{ number_format($cart->items->sum(fn($item) => $item->shopItem->price * $item->quantity), 2) }} EGP</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 order-lg-1">
                    <div class="contact-info bg-white p-4 rounded shadow-sm mb-4">
                        <h3 class="cart-total__text text-uppercase mb-4">Contact Information</h3>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="contact-one__field">
                                        <label>First Name:</label>
                                        <input type="text" name="first_name" value="{{ auth()->user()->first_name }}" required>
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="contact-one__field">
                                        <label>Last Name:</label>
                                        <input type="text" name="first_name" value="{{ auth()->user()->last_name }}" required>
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="contact-one__field">
                                        <label>Email:</label>
                                        <input type="email" name="email" value="{{ auth()->user()->email }}" required>
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="contact-one__field">
                                        <label>Phone Number:</label>
                                        <input type="number" name="phone" value="{{ auth()->user()->phone }}" required>
                                    </p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <p class="contact-one__field">
                                        <label>Address:</label>
                                        <textarea name="address" required>{{ auth()->user()->address }}</textarea>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Methods -->
                    <div class="payment-methods">
                        <h3 class="cart-total__text text-uppercase mb-4">Payment Method</h3>
                        
                        <form id="payment-form" action="{{ route('gem.cart.checkout.process') }}" method="POST">
                            @csrf
                            <div class="payment-methods__options">
                                <!-- Cash Payment -->
                                <div class="payment-method">
                                    <input type="radio" name="payment_method" id="cash" value="cash" checked>
                                    <label for="cash" class="d-flex align-items-center">
                                        <span class="payment-method__radio"></span>
                                        <span class="payment-method__icon">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </span>
                                        <span class="payment-method__text">Cash on Delivery</span>
                                    </label>
                                </div>

                                <!-- Stripe Payment -->
                                <div class="payment-method">
                                    <input type="radio" name="payment_method" id="stripe" value="stripe">
                                    <label for="stripe" class="d-flex align-items-center">
                                        <span class="payment-method__radio"></span>
                                        <span class="payment-method__icon">
                                            <i class="fab fa-cc-stripe"></i>
                                        </span>
                                        <span class="payment-method__text">Pay with Card</span>
                                    </label>
                                </div>

                                <!-- Stripe Elements Placeholder -->
                                <div id="stripe-elements" class="mt-3" style="display: none;">
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                                </div>
                            </div>

                            <button type="submit" class="thm-btn cart-update__btn cart-update__btn-three mt-4">
                                Complete Order <span>+</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
    .payment-methods {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .payment-method {
        margin-bottom: 1rem;
        padding: 1rem;
        border: 1px solid #eee;
        border-radius: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-method:hover {
        border-color: #d99578;
    }

    .payment-method input[type="radio"] {
        display: none;
    }

    .payment-method label {
        margin: 0;
        cursor: pointer;
        width: 100%;
    }

    .payment-method__radio {
        width: 20px;
        height: 20px;
        border: 2px solid #ddd;
        border-radius: 50%;
        margin-right: 1rem;
        position: relative;
    }

    .payment-method input[type="radio"]:checked + label .payment-method__radio::after {
        content: '';
        width: 12px;
        height: 12px;
        background: #d99578;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .payment-method input[type="radio"]:checked ~ .payment-method {
        border-color: #d99578;
    }

    .payment-method__icon {
        margin-right: 1rem;
        font-size: 1.5rem;
        color: #d99578;
    }

    #stripe-elements {
        padding: 1rem;
        border: 1px solid #eee;
        border-radius: 5px;
    }

    .payment-method.selected {
        border-color: #d99578;
        background-color: rgba(217, 149, 120, 0.05);
    }
    </style>

    @if(config('services.stripe.key'))
        @push('scripts')
            <script src="https://js.stripe.com/v3/"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('payment-form');
                    const contactForm = document.getElementById('contactForm');

                    // Handle payment method selection
                    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
                        input.addEventListener('change', function() {
                            // Remove selected class from all payment methods
                            document.querySelectorAll('.payment-method').forEach(method => {
                                method.classList.remove('selected');
                            });
                            
                            // Add selected class to parent payment method
                            this.closest('.payment-method').classList.add('selected');
                        });
                    });

                    // Handle form submission
                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
                        if (!selectedMethod) {
                            alert('Please select a payment method');
                            return;
                        }

                        // First update contact information
                        const formData = new FormData(contactForm);
                        try {
                            const response = await fetch('/user/update-contact', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify(Object.fromEntries(formData))
                            });

                            if (!response.ok) {
                                throw new Error('Failed to update contact information');
                            }

                            // Submit the payment form
                            form.submit();
                        } catch (error) {
                            console.error('Error updating contact information:', error);
                            alert('Failed to update contact information. Please try again.');
                        }
                    });
                });
            </script>
        @endpush
    @endif
@endsection