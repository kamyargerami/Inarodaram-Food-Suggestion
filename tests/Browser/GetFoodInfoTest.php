<?php

namespace Tests\Browser;

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
            if ($index == 0) continue;

            $this->browser->visit($food['link']);
            $foods[$index]['items_needed'] = explode(PHP_EOL, trim($this->browser->text('ul.recipe-ingredient')));
            $foods[$index]['recipe'] = explode(PHP_EOL, trim($this->browser->text('ol.recipe-ingredient')));
            $foods[$index]['details'] = $this->browser->text('#page div p') != 'مطالب پیشنهادی از سراسر وب' ? trim($this->browser->text('#page div p')) : null;

            $tags_elements = $this->browser->elements('.tag-span > *');
            array_shift($tags_elements);

            for ($i = 0; $i < count($tags_elements); $i++) {
                $foods[$index]['tags'][trim($tags_elements[$i]->getText())] = trim($tags_elements[++$i]->getText());
            }

            $foods[$index]['image'] = $this->browser->attribute('.recipe-image', 'src');

            dd($foods[$index]);
        }

        $export_file = fopen("final.json", "w") or die("Unable to open file!");
        fwrite($export_file, json_encode($foods));
        fclose($export_file);
    }
}
