<?php

namespace App\Http\Controllers\web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Services\Museum\CollectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function __construct(protected CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function gemCollections()
    {
        $categories = $this->collectionService->getCategoriesWithCollections(limit:8);
        
        return view('website.gem.collections.index' , get_defined_vars());
    }

    public function show(Collection $collection)
    {
        $collections = $this->collectionService->getCollections();
        $collection = $this->collectionService->getCollection($collection->id);
        $adjacentCollections = $this->collectionService->getAdjacentCollections($collection->id);

         return view('website.gem.collections.show', [
            'collection' => $collection,
            'collections' => $collections,
            'prevCollection' => $adjacentCollections['prev'],
            'nextCollection' => $adjacentCollections['next'],
        ]);
    }

    public function showByCategory(Request $request, $slug)
    {
        $category = $this->collectionService->getCategoriesWithCollections(slug:$slug);

        if (!$category) {
            abort(404);
        }

        $categories = $this->collectionService->getCategories();

        $filteredCategoryId = $request->get('category_id');
        
        if ($filteredCategoryId && $filteredCategoryId != $category->id) {
            $category = $categories->firstWhere('id', $filteredCategoryId);
        }

        $collections = $category->collections()->paginate(6);

        $view = View::exists('website.gem.collections.categories.partials.' . Str::slug($category->name))
        ? 'website.gem.collections.categories.default'
        : 'website.gem.collections.categories.default';

        return view($view, compact('category', 'categories', 'collections'));
    }
}
