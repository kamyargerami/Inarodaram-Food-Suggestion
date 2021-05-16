<?php

namespace Tests\Browser;

use App\Models\Food;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GetFoodInfoTest extends DuskTestCase
{
    public $browser;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testGetFoodDetails()
    {
        $foods = json_decode(file_get_contents('links.json'), true);

        $this->browse(function (Browser $browser) {
            $this->browser = $browser;
        });

        foreach ($foods as $index => $food) {
            $this->browser->visit($food['link']);
            $foods[$index]['items_needed'] = trim($this->browser->text('ul.recipe-ingredient'));
            $foods[$index]['recipe'] = trim($this->browser->text('ol.recipe-ingredient'));
            $foods[$index]['details'] = $this->browser->text('#page div p') != 'مطالب پیشنهادی از سراسر وب' ? trim($this->browser->text('#page div p')) : null;

            $tags_elements = $this->browser->elements('.tag-span > *');
            array_shift($tags_elements);

            for ($i = 0; $i < count($tags_elements); $i++) {
                $foods[$index]['tags'][trim($tags_elements[$i]->getText())] = trim($tags_elements[++$i]->getText());
            }

            $foods[$index]['image'] = $this->browser->attribute('.recipe-image', 'src');

            Food::firstOrCreate([
                'name' => $foods[$index]['title'],
            ], [
                'categories' => $foods[$index]['categories'] ?? null,
                'meals' => $foods[$index]['meal'] ?? null,
                'requirements' => $foods[$index]['requirements'] ?? null,
                'link' => $foods[$index]['link'] ?? null,
                'items_needed' => $foods[$index]['items_needed'] ?? null,
                'recipe' => $foods[$index]['recipe'] ?? null,
                'details' => $foods[$index]['details'] ?? null,
                'tags' => $foods[$index]['tags'] ?? null,
                'images' => [
                    $foods[$index]['image']
                ],
            ]);
        }
    }
}
