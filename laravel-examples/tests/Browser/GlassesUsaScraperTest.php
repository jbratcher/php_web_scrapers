<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\WebDriverBy;
use App\Scrapers\Scraper;

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
    public function getFramesTest()
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
                    ;


        });
    }
}

