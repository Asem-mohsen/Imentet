<?php 
namespace App\Repositories;

use App\Models\{Collection, CollectionCategory};
use Illuminate\Database\Eloquent\Builder;

class CollectionRepository
{
    public function getAllCollections(?string $placeName = null,?int $limit = null)
    {
        $query = Collection::query();

        if ($placeName) {
            $query->whereHas('places', function (Builder $q) use ($placeName) {
                $q->where('name->en', $placeName);
            });
        }

        if ($limit) {
            $query->limit($limit);
        }
    
        return $query->get();
    }

    public function getCategoriesWithCollections(?string $placeName = null, ?string $slug = null, ?int $limit = null)
    {
        $query = CollectionCategory::query()->with(['collections' => function ($query) use ($placeName) {
            $query->whereHas('places', function ($q) use ($placeName) {
                $q->where('name->en', $placeName);
            });
        }]);
    
        if ($limit) {
            $query->limit($limit);
        }
    
        $categories = $query->get();
    
        if ($slug) {
            return $categories->firstWhere(fn($category) => $category->slug === $slug);
        }
    
        return $categories;
    }

    public function findById(int $id)
    {
        return Collection::findOrFail($id);
    }

    public function getCategories()
    {
        return CollectionCategory::withCount('collections')->get();
    }
    
    public function getAdjacentCollection(int $collectionId, string $direction, string $placeName): ?Collection
    {
        $operator = $direction === 'prev' ? '<' : '>';
        $orderBy = $direction === 'prev' ? 'desc' : 'asc';

        return Collection::where('id', $operator, $collectionId)
            ->whereHas('places', function ($query) use ($placeName) {
                $query->where('name->en', $placeName);
            })
            ->orderBy('id', $orderBy)
            ->first();  
    }
}