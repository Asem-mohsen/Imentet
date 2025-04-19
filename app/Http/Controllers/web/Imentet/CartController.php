<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        return view('website.gem.cart.index', compact('cart'));
    }

    public function pyramidsCart()
    {
        $cart = $this->cartService->getCart();
        return view('website.pyramids.cart.index', compact('cart'));
    }

    public function addToCart(AddToCartRequest $request)
    {
        $validated = $request->validated();

        return $this->cartService->addToCart($validated['shop_item_id'], $validated['quantity']);
    }

    public function getCartItems()
    {
        return response()->json($this->cartService->getCartItems());
    }

    public function removeFromCart($cartItemId)
    {
        $cart = $this->cartService->getCart();

        if (!$cart) {
            return response()->json(['status' => 'error', 'message' => 'Cart not found'], 404);
        }

        $this->cartService->removeFromCart($cartItemId);

        return response()->json(['status' => 'success', 'message' => 'Item removed from cart!', 'cartCount' => $cart->items()->count() , 'totalPrice' => number_format($cart->items->sum(fn ($item) => $item->shopItem->price * $item->quantity), 2)]);
    }

    public function clearCart()
    {
        $this->cartService->clearCart();

        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function updateQuantity(Request $request, $cartItemId)
    {
        return $this->cartService->updateQuantity($cartItemId, $request->quantity);
    }

    public function checkout()
    {
        $cart = $this->cartService->getCart();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('gem.cart.index')->with('error', 'Your cart is empty.');
        }

        return view('website.gem.cart.checkout', compact('cart'));
    }
}
