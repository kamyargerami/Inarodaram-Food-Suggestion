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
            if ($request->requirements) {
                foreach ($request->requirements as $requirement) {
                    $query->whereJsonContains('requirements', $requirement);
                }
            }
        })->inRandomOrder('id')->paginate(20);

        return view('home', compact('foods'));
    }

    public function view(Food $food)
    {
        return view('food', compact('food'));
    }

    public function category($category)
    {
        $foods = Food::where(function ($query) use ($category) {
            $query->whereJsonContains('categories', $category);
        })->inRandomOrder('id')->paginate(20);

        return view('home', compact('foods'));
    }

    public function meal($meal)
    {
        $foods = Food::where(function ($query) use ($meal) {
            $query->whereJsonContains('meals', $meal);
        })->inRandomOrder('id')->paginate(20);

        return view('home', compact('foods'));
    }
}
