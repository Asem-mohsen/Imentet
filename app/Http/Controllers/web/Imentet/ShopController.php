<?php

namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Models\ShopItem;
use App\Services\ShopItemsService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct(protected ShopItemsService $shopItemsService)
    {
        $this->shopItemsService = $shopItemsService;
    }

    public function index(Request $request)
    {
        $sortOption = $request->input('Sort', 'default');
    
        $products = $this->shopItemsService->getSortedProducts($sortOption, 12);
    
        return view('website.gem.shop.index', compact('products'));
    }

    public function pyramidsShop(Request $request)
    {
        $sortOption = $request->input('Sort', 'default');
    
        $products = $this->shopItemsService->getSortedProducts($sortOption, 12);
    
        return view('website.pyramids.shop.index', compact('products'));
    }

    public function show(ShopItem $shopItem)
    {
        $product = $this->shopItemsService->getProduct($shopItem->id);

        $products = $this->shopItemsService->getProducts();

        return view('website.gem.shop.show', compact('product' , 'products'));
    }

    public function pyramidsShow(ShopItem $shopItem)
    {
        $product = $this->shopItemsService->getProduct($shopItem->id);

        $products = $this->shopItemsService->getProducts();

        return view('website.pyramids.shop.show', compact('product' , 'products'));
    }
}
