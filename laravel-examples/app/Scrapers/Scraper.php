<?php

namespace App\Scrapers;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class Scraper
{
    /**
     * @var string
     */
    protected $base_url;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Crawler|NULL
     */
    protected $crawler;

    /**
     * @var boolean
     */
    protected $use_dusk_browser;

    public function __construct()
    {
        $this->client = new Client();

        if($this->use_dusk_browser)
        {
            static::startChromeDriver();
        }
    }

    abstract public function run();

    /**
     * @param $url string
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function get($url)
    {
        return $this->client->request('GET', $url);
    }

    /**
     * @param $url string
     * @param $selector string
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function index($url, $selector)
    {
        return $this->get($url, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36',
            ]
        ])->filter($selector);
    }

}
