@extends('layout.template.gem-template')

@section('title' , 'Order Success')

@section('content')
<div class="container">
    <ul class="list-unstyled thm-breadcrumb thm-breadcrumb__two">
        <li><a href="{{route('gem.home')}}">Home</a></li>
        <li><a href="{{route('gem.shop.index')}}">Shop</a></li>
        <li>Order Success</li>
    </ul>
</div>

<section class="success-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="success-content text-center">
                    <div class="success-icon mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h2 class="mb-4">Thank You for Your Order!</h2>
                    <p class="mb-4">Your order has been successfully placed. We have sent a confirmation email with your order details.</p>
                    
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('profile.orders') }}" class="thm-btn cart-update__btn cart-update__btn-three">
                            View Orders <span>+</span>
                        </a>
                        <a href="{{ route('gem.shop.index') }}" class="thm-btn cart-update__btn cart-update__btn-two">
                            Continue Shopping <span>+</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.success-page {
    padding: 5rem 0;
}

.success-content {
    background: #fff;
    padding: 3rem;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
}

.gap-3 {
    gap: 1rem;
}
</style>
@endsection