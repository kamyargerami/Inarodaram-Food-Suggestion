<?php


namespace App\Http\Controllers;


use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FoodsController extends Controller
{
    public function index(Request $request)
    {
        Cache::rememberForever('requirements', function () {
            $all = Food::select('requirements')->pluck('requirements');
            $requirements = [];
            foreach ($all as $food) {
                foreach ($food as $requirement) {
                    $requirements[] = $requirement;
                }
            }

            return array_unique($requirements);
        });

        $foods = Food::where(function ($query) use ($request) {
            if ($request->name) {
                $query->where('name', 'like', "%$request->name%");
            } elseif ($request->requirements) {
                foreach ($request->requirements as $index => $requirement) {
                    if ($index > 5) continue;
                    $query->whereJsonContains('requirements', $requirement);
                }
            }
        })->inRandomOrder()->paginate(20)->onEachSide(0);

        $similar_foods = [];
        if ($foods->total() < 7) {
            $similar_foods = Food::where(function ($query) use ($request) {
                if ($request->name) {
                    $query->where('name', 'like', "%$request->name%");
                } elseif ($request->requirements) {
                    foreach ($request->requirements as $index => $requirement) {
                        if ($index > 5) continue;
                        $query->orwhereJsonContains('requirements', $requirement);
                    }
                }
            })->inRandomOrder()->take(20)->get();
        }

        return view('home', compact('foods', 'similar_foods'));
    }

    public function view(Food $food)
    {
        $related = Food::where(function ($query) use ($food) {
            if ($food->categories) {
                foreach ($food->categories as $category) {
                    $query->orwhereJsonContains('categories', $category);
                }
            }
        })->inRandomOrder('id')->take(4)->get();
        return view('food', compact('food', 'related'));
    }

    public function category($category)
    {
        $foods = Food::where(function ($query) use ($category) {
            $query->whereJsonContains('categories', $category);
        })->inRandomOrder('id')->paginate(20)->onEachSide(0);

        return view('home', compact('foods'));
    }

    public function meal($meal)
    {
        $foods = Food::where(function ($query) use ($meal) {
            $query->whereJsonContains('meals', $meal);
        })->inRandomOrder('id')->paginate(20)->onEachSide(0);

        return view('home', compact('foods'));
    }
}
