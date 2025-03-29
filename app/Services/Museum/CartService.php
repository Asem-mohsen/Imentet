<?php 

namespace App\Services\Museum;

use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function __construct(protected CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getCartItemCount()
    {
        return $this->cartRepository->getCartItemCount();
    }

    public function getCart()
    {
        $cart = Auth::check()
        ? $this->cartRepository->getCartByUser(Auth::id())
        : $this->cartRepository->getCartBySession(Session::getId());

        // If the cart is null, create a new one
        if (!$cart) {
            $cart = Auth::check()
                ? $this->cartRepository->createCart(Session::getId(), Auth::id())
                : $this->cartRepository->createCart(Session::getId());
    }

    return $cart;
    }

    public function addToCart($shopItemId, $quantity)
    {
        $cart = $this->getCart();

        if (!$cart) {
            return response()->json(['status' => 'error', 'message' => 'Unable to find or create a cart!'], 400);
        }

        $existingItem = $this->cartRepository->findCartItem($cart->id, $shopItemId);

        if ($existingItem) {
            $this->cartRepository->updateItemQuantity($existingItem->id, $existingItem->quantity + $quantity);
            return response()->json(['status' => 'success', 'message' => 'Item quantity updated!', 'cartCount' => $cart->items()->count()]);
        }

        $this->cartRepository->addItem($cart->id, $shopItemId, $quantity);

        return response()->json(['status' => 'success', 'message' => 'Item added to cart successfully!', 'cartCount' => $cart->items()->count()]);
    }

    public function getCartItems()
    {
        $cart = $this->getCart();
        return $this->cartRepository->getCartItems($cart->id);
    }

    public function removeFromCart($cartItemId)
    {
        $this->cartRepository->removeItem($cartItemId);
    }

    public function clearCart()
    {
        $cart = $this->getCart();
        $this->cartRepository->clearCart($cart);
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        $this->cartRepository->updateItemQuantity($cartItemId, $quantity);
    }
}

