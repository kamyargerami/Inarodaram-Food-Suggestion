<?php


namespace App\Http\Controllers;


use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FoodsController extends Controller
{
    public function index(Request $request)
    {
        $requirements = Cache::rememberForever('requirements', function () {
            $all = Food::select('requirements')->pluck('requirements');
            $requirements = [];
            foreach ($all as $food) {
                foreach ($food as $requirement) {
                    $requirements[] = $requirement;
                }
            }

            return array_unique($requirements);
        });

        $categories = Cache::rememberForever('categories', function () {
            $all = Food::select('categories')->pluck('categories');
            $categories = [];
            foreach ($all as $food) {
                foreach ($food as $category) {
                    $categories[] = $category;
                }
            }

            return array_unique($categories);
        });


        $foods = Food::where(function ($query) use ($request) {
            if ($request->requirements) {
                foreach ($request->requirements as $requirement) {
                    $query->whereJsonContains('requirements', $requirement);
                }
            }
        })->inRandomOrder('id')->paginate(20);

//        dd($foods);
        return view('home', compact('foods', 'requirements', 'categories'));
    }

    public function view(Food $food)
    {
        return view('food', compact('food'));
    }
}
