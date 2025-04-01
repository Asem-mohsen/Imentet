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
        
        switch ($sortOption) {
            case '1': // Top Selling
                $products = ShopItem::orderByDesc('sales_count')->paginate(12);
                break;
            case 'ASC': // Lowest Price
                $products = ShopItem::orderBy('price')->paginate(12);
                break;
            case 'DESC': // Highest Price
                $products = ShopItem::orderByDesc('price')->paginate(12);
                break;
            default: // Default Sorting
                $products = $this->shopItemsService->getProducts(10);
                break;
        }

        return view('website.gem.shop.index', compact('products'));
    }

    public function pyramidsShop(Request $request)
    {
        $sortOption = $request->input('Sort', 'default');
        
        switch ($sortOption) {
            case '1': // Top Selling
                $products = ShopItem::orderByDesc('sales_count')->paginate(12);
                break;
            case 'ASC': // Lowest Price
                $products = ShopItem::orderBy('price')->paginate(12);
                break;
            case 'DESC': // Highest Price
                $products = ShopItem::orderByDesc('price')->paginate(12);
                break;
            default: // Default Sorting
                $products = $this->shopItemsService->getProducts(10);
                break;
        }

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
