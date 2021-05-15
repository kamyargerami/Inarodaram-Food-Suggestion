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
        return Cache::rememberForever('categories', function () {
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
//                $this->browser->visit($category['link'] . 'page/' . $current_page);
                $this->browser->visit('http://chibepazam.ir/?s=%DA%A9%D8%A8%D8%A7%D8%A8+%D8%AD%D9%84%D8%B2%D9%88%D9%86%DB%8C');

                $titles = $this->browser->elements('.search-text > a');
                foreach ($titles as $title) {
                    $this->foods[] = [
                        'title' => $title->getAttribute('title'),
                        'link' => $title->getAttribute('href')
                    ];
                }

                $requirements = $this->browser->elements('.search-text > p > strong');
                foreach ($requirements as $index => $requirement) {
                    $requirement_text = explode(' ، ', str_replace('مواد مورد نياز: ', '', $requirement->getText()));
                    $this->foods[$index]['requirements'] = $requirement_text;
                }

                $other_texts = $this->browser->elements('.search-text > p:nth-child(3)');
                foreach ($other_texts as $index => $other_text) {
                    $there_line = explode('<br>', trim($other_text->getAttribute('innerHTML')));

                    $this->foods[$index]['categories'] = explode(' ، ', str_replace('نوع غذا: ', '', trim(preg_replace('/\t+/', '', strip_tags(str_replace('&nbsp;', '', $there_line[0]))))));
                    $this->foods[$index]['vade'] = explode(' و ', str_replace('مي توني اينو واسه ', '', str_replace(' درست کني!', '', trim(preg_replace('/\t+/', '', strip_tags(str_replace('&nbsp;', '', $there_line[1])))))));
                }
            }
        }

        $export_file = fopen("links.json", "w") or die("Unable to open file!");
        fwrite($export_file, json_encode($this->foods));
        fclose($export_file);
    }
}
