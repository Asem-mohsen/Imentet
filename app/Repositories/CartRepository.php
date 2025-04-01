<?php 
namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartRepository
{
    public function getCart()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->with('items')->first();
        } else {
            $sessionId = Session::getId();
            return Cart::where('session_id', $sessionId)->with('items')->first();
        }
    }

    public function getCartItemCount(): int
    {
        $cart = $this->getCart();
        return $cart ? $cart->items->count() : 0;
    }

    public function findCartItem($cartId, $shopItemId)
    {
        return CartItem::where('cart_id', $cartId)->where('shop_item_id', $shopItemId)->first();
    }

    public function getCartByUser($userId)
    {
        return Cart::where('user_id', $userId)->first();
    }

    public function getCartBySession($sessionId)
    {
        return Cart::where('session_id', $sessionId)->first();
    }

    public function createCart($sessionId, $userId = null)
    {
        return Cart::create([
            'session_id' => $sessionId,
            'user_id' => $userId,
        ]);
    }

    public function addItem($cartId, $shopItemId, $quantity = 1)
    {
        return CartItem::create([
            'cart_id'      => $cartId,
            'shop_item_id' => $shopItemId,
            'quantity'     => $quantity,
        ]);
    }

    public function getCartItems($cartId)
    {
        return CartItem::where('cart_id', $cartId)->get();
    }

    public function removeItem($cartItemId)
    {
        return CartItem::where('shop_item_id', $cartItemId)->delete();
    }

    public function clearCart($cart)
    {
        return $cart->items()->delete();
    }

    public function updateItemQuantity($cartItemId, $quantity)
    {
        return CartItem::where('id', $cartItemId)->update(['quantity' => $quantity]);
    }
}