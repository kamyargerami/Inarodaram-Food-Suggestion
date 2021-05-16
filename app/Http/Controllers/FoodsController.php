<?php


namespace App\Http\Controllers;


use App\Models\Food;
use Illuminate\Support\Facades\Cache;

class FoodsController extends Controller
{
    public function index()
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

        $foods = Food::inRandomOrder('id')->paginate(20);
        return view('home', compact('foods', 'requirements', 'categories'));
    }

    public function view(Food $food)
    {
        return view('food', compact('food'));
    }
}
