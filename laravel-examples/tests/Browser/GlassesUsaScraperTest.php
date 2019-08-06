<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Symfony\Component\DomCrawler\Crawler;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\WebDriverBy;
use App\Scrapers\Scraper;
use Illuminate\Support\Facades\DB;
use App\Frame;

class GlassesUsaScraper extends DuskTestCase
{

    /**
     * @var string
     */
    protected $base_url = "https://www.glassesusa.com";

    /**
     * @var string
     */
    protected $brands_url = "/eyeglasses-collection";

    /**
     * @var int
     */
    protected $counter = 0;

    /**
     * @var array
     * key frames
     */
    protected $frames = [];

    /**
     * @test
     *
     * Get frames
     *
     * @return frames[]
     */
    public function runTest()
    {

        $this->getFramesFromDB();

        $this->getFramesFromUrl();

    }

    public function getFramesFromDB()
    {

        $this->frames_object = DB::table('frames')->get();

        // https://stackoverflow.com/questions/6815520/cannot-use-object-of-type-stdclass-as-array
        // DB::table get returns a stdClass Oject, this converts it into an array
        $this->frames = json_decode(json_encode($this->frames_object), True);

    }

    public function getFramesFromUrl()
    {

        $url = $this->base_url . $this->brands_url;

        echo PHP_EOL;
        echo "GET url: " . $url . PHP_EOL;

        $this->browse(function (Browser $browser) use ($url) {

            $browser
                    ->maximize()
                    ->visit($url)
                    ->assertTitleContains("yeglasses")
                    ->assertPresent(".dropdown__control___1T9Cj")
                    ->driver->executeScript('document.querySelector("div.overlay-welPopUp").style.display = "none"');

            $browser
                    ->click(".dropdown__control___1T9Cj")
                    ->assertPresent(".dropdown__list___2k2Xq")
                    ->click(".dropdown__list___2k2Xq")
                    ->pause(2000)
                    ->assertPresent('.categoryList__list___13EnT')
                    ->waitFor('.glassesItem__glassesItem___LY6il')
                    ;

            foreach ($browser->elements('[data-test-name="product"]') as $element) {

                $img = $element->findElement(WebDriverBy::cssSelector('[data-test-name="itemImage"]'))->getAttribute("src");
                $name = $element->findElement(WebDriverBy::cssSelector('[data-test-name="productTitle"]'))->getText();
                $price = $element->findElement(WebDriverBy::cssSelector('[data-test-name="regularPrice"]'))->getText();

                print_r("Name: " . $name . PHP_EOL);
                print_r("Price: " . $price . PHP_EOL);
                print_r("Image: " . $img . PHP_EOL);

                /*->
                 *  @var WebDriverElement $element
                */
                $frame = Frame::updateOrCreate([
                    'name' => $name,
                    'image' => $img,
                    'price' => $price
                ]);

                $this->frames[] = $frame;

                print("Frame: ");
                print_r($frame) . PHP_EOL;

            }

            print_r("Number of frames: " . count($this->frames));

        });

    }



}

