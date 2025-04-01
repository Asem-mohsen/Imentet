@extends('layout.template.gem-template')

@section('title' , 'Cart')

@section('content')

  <div class="container">
      <ul class="list-unstyled thm-breadcrumb thm-breadcrumb__two">
          <li><a href="{{route('gem.home')}}">Home</a></li>
          <li><a href="{{route('gem.shop.index')}}">Shop</a></li>
          <li>Shopping Cart</li>
      </ul>
  </div>

  <!-- Cart Details -->
  <section class="cart-page">
    <div class="container">
        <div class="cart-total">
            <h3 class="cart-total__text text-uppercase">Your Cart: 
              <span class="text-capitalize" id="cart-items-count">
                {{ $cart->items->count() }} item{{ $cart->items->count() !== 1 ? 's' : '' }}
              </span>
            </h3>
            <h3 class="cart-total__text text-uppercase">Total Price: 
              <span class="text-capitalize cart-total__highlight"  id="total-price">
                {{ number_format($cart->items->sum(fn($item) => $item->shopItem->price * $item->quantity), 2) }} EGP
              </span>
            </h3>
        </div>
          <div class="cart-main">
              <div class="table-outer table-responsive">
                  <table class="cart-table" id="myTable">
                      <thead class="cart-header">
                          <tr>
                              <th class="prod-column">Product</th>
                              <th class="price">Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Remove</th>
                          </tr>
                      </thead>
                      <tbody id="cart-table">
                        @forelse($cart->items as $item)
                          <tr>
                              <td class="prod-column">
                                  <div class="column-box">
                                      <figure class="prod-thumb">
                                        <a href="{{route('gem.shop.products.show' , $item->shop_item_id)}}">
                                          <img src="{{$item->shopItem->getFirstMediaUrl('shop_item')}}" width="100px" height="100px" style="padding-right:20px;" alt="">
                                        </a>
                                      </figure>
                                      <h3 class="prod-title padd-top-20">{{$item->shopItem->name}}</h3>
                                  </div>
                              </td>
                              <td class="price">
                                {{$item->shopItem->price}}
                              </td>
                              <td class="qty">
                                <input class="quantity-spinner Quantity" onchange="subTotal()" type="number" min="1" max="{{$item->shopItem->stock_quantity}}"  value="1" name="quantity[]">
                              </td>
                              <td class="sub-total SubTotal"></td>
                              <td class="remove">
                                <button type="button"
                                      class="remove-btn"
                                      data-remove-url="{{ route('gem.cart.remove', $item->shop_item_id) }}">
                                  <span class="egypt-icon-remove"></span> 
                                </button>
                              </td>
                          </tr>
                        @empty 
                        @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
        <div class="cart-update">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    
                </div>
                <div class="col-lg-5">
                  <div class="cart-update__button-box">
                    <a href="{{route('gem.shop.index')}}" class="thm-btn cart-update__btn cart-update__btn-two">Continue Shopping</a>
                    @if (auth()->user())
                        <button type="submit" class="thm-btn cart-update__btn cart-update__btn-three">Checkout <span>+</span></button>
                    @else
                        <a href="{{route('auth.login.index')}}" class="thm-btn cart-update__btn cart-update__btn-three">Sign In to Continue</a>
                    @endif
                  </div>
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection

@section('js')
  @include('components.scripts.cart-actions')
@endsection