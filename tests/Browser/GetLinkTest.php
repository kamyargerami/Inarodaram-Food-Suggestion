<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Cache;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GetLinkTest extends DuskTestCase
{
    public $browser;
    public $categories, $foods = [];

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testGetLinks()
    {
        $this->browse(function (Browser $browser) {
            $this->browser = $browser;
        });

        $this->categories = $this->getCategories();
        $this->getFoods();
    }

    public function getCategories()
    {
        return Cache::rememberForever('chibepazam_categories', function () {
            $this->browser->visit('http://chibepazam.ir/category/rice/');

            $categories = $this->browser->elements('.side-category-list a');
            $result = [];

            foreach ($categories as $category) {
                $result[] = [
                    'title' => $category->getText(),
                    'link' => $category->getAttribute('href'),
                ];
            }


            foreach ($result as $index => $data) {
                $this->browser->visit($data['link']);
                $result[$index]['last_page'] = intval(trim(explode('از', $this->browser->text('.pages'))[1]));
            }

            return $result;
        });
    }

    public function getFoods()
    {
        foreach ($this->categories as $category) {
            for ($current_page = 1; $current_page <= $category['last_page']; $current_page++) {
                $this->browser->visit($category['link'] . 'page/' . $current_page);
                for ($i = 3; $i <= 21; $i += 2) {
                    if ($this->browser->element('#ajax-content > div:nth-of-type(' . $i . ') > .search-text')) {
                        $this->browser->with('#ajax-content > div:nth-of-type(' . $i . ') > .search-text', function ($element) {
                            $this->foods[] = [
                                'title' => trim($element->element('a')->getAttribute('title')),
                                'categories' => explode(' ، ', trim(str_replace('نوع غذا: ', '', explode(PHP_EOL, $element->element('p:nth-of-type(2)')->getText())[0]))),
                                'meal' => explode(' و ', trim(str_replace(' درست کني!', '', str_replace('مي توني اينو واسه ', '', explode(PHP_EOL, $element->element('p:nth-of-type(2)')->getText())[1])))),
                                'requirements' => explode(' ، ', trim(str_replace('مواد مورد نياز: ', '', $element->element('p strong')->getText()))),
                                'link' => trim($element->element('a')->getAttribute('href'))
                            ];
                        });
                    }
                }
            }
        }

        $export_file = fopen("links.json", "w") or die("Unable to open file!");
        fwrite($export_file, json_encode($this->foods));
        fclose($export_file);
    }
}
