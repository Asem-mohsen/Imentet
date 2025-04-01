<?php 
namespace App\Repositories;

use App\Models\Event;
use App\Models\EventCategory;

class EventRepository
{
    public function getAllEvents(?string $categoryName = null, ?string $placeName = null ,array $where = [],array $whereDates = [], array $orderBy = [], ?int $limit = null, ?int $paginate = null,array $excludeCategories = [])
    {
        $query = Event::when($categoryName, function ($query) use ($categoryName) {
                $query->whereHas('category', function ($query) use ($categoryName) {
                    $query->where('name->en', $categoryName);
                });
            })
            ->when($placeName, function ($query) use ($placeName) {
                $query->whereHas('place', function ($query) use ($placeName) {
                    $query->where('name->en', $placeName);
                });
            })
            ->when(!empty($excludeCategories), function ($query) use ($excludeCategories) {
                $query->whereDoesntHave('category', function ($query) use ($excludeCategories) {
                    $query->whereIn('name->en', $excludeCategories);
                });
            })
            ->when(!empty($where), function ($query) use ($where) {
                foreach ($where as $column => $condition) {
                    if (is_array($condition)) {
                        if (isset($condition['operator'], $condition['value'])) {
                            $query->where($column, $condition['operator'], $condition['value']);
                        }
                    } else {
                        $query->where($column, $condition);
                    }
                }
            })
            ->when(!empty($whereDates), function ($query) use ($whereDates) {
                foreach ($whereDates as $column => $condition) {
                    if (isset($condition['operator'], $condition['value'])) {
                        if (strtoupper($condition['operator']) === 'BETWEEN' && is_array($condition['value'])) {
                            $query->whereBetween($column, $condition['value']);
                        } else {
                            $query->whereDate($column, $condition['operator'], $condition['value']);
                        }
                    }
                }
            })
            ->when(!empty($orderBy), function ($query) use ($orderBy) {
                foreach ($orderBy as $column => $direction) {
                    $query->orderBy($column, $direction);
                }
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            });

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }

    public function getCategories(array $where = [], array $excludeNames = [], ?string $placeName = null, ?int $limit = null)
    {
        $query = EventCategory::when(!empty($where), function ($query) use ($where) {
            foreach ($where as $column => $condition) {
                if (is_array($condition)) {
                    if (isset($condition['operator'], $condition['value'])) {
                        $query->where($column, $condition['operator'], $condition['value']);
                    }
                } else {
                    $query->where($column, $condition);
                }
            }
        })
        ->when(!empty($excludeNames), function ($query) use ($excludeNames) {
            $query->whereNotIn('name->en', $excludeNames);
        });
    
        if ($limit) {
            $query->limit($limit);
        }
    
        return $query->get();
    }

    public function getExhibitionEvents()
    {
        $today = now()->toDateString();

        // Current Exhibitions (happening now)
        $current = Event::whereHas('category', function ($query) {
                $query->where('name->en', 'Exhibitions');
            })
            ->where('start_time', '<=', $today)
            ->where('end_time', '>=', $today)
            ->orderBy('start_time', 'asc')
            ->get();

        // Upcoming Exhibitions (future events)
        $upcoming = Event::whereHas('category', function ($query) {
                $query->where('name->en', 'Exhibitions');
            })
            ->where('start_time', '>', $today)
            ->orderBy('start_time', 'asc')
            ->get();

        // Past Exhibitions (already finished)
        $past = Event::whereHas('category', function ($query) {
                $query->where('name->en', 'Exhibitions');
            })
            ->where('end_time', '<', $today)
            ->orderBy('end_time', 'desc')
            ->get();

        return compact('current', 'upcoming', 'past');
    }

    public function getPriceByCategory(Event $event, string $category)
    {
        return $event->prices()->where('category', $category)->first();
    }

    public function findById(int $id)
    {
        return Event::findOrFail($id);
    }

    public function paginationEventsShow(int $id)
    {
        $prevEvent = Event::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $nextEvent = Event::where('id', '>', $id)->orderBy('id', 'asc')->first();

        return compact('prevEvent', 'nextEvent');
    }

    public function findBy(array $conditions)
    {
        return EventCategory::where($conditions)->first();
    }
}