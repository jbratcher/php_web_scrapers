<?php

namespace App\Scrapers;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

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

    public function __construct()
    {
        $this->client = new Client();
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
