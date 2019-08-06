<?php

namespace App\Scrapers;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Laravel\Dusk\Browser;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Illuminate\Support\Facades\DB;
use App\Post;

class Reddit extends Scraper
{
    /**
     * @var string
     */
    protected $base_url = "https://reddit.com";

    /**
     * @var string
     */
    protected $frontpage_url = "/r/all/";

    /**
     * @var int
     */
    protected $counter = 0;

    /**
     * @var array
     * key subbreddit
     */
    protected $subbreddits = [];

    protected $subreddit_urls = [];

    protected $reddit_posts = [];

    /**
     * Visit the locations event page and get all events and data
     */
    public function run()
    {

        $this->reddit_posts_object = DB::table('posts')->get();

        // https://stackoverflow.com/questions/6815520/cannot-use-object-of-type-stdclass-as-array
        // DB::table get returns a stdClass Oject, this converts it into an array
        $this->reddit_posts = json_decode(json_encode($this->reddit_posts_object), True);

        $this->getPosts();

    }

    /**
     * @var array
     *
     * Gets event data for each state and stores it to the Events table
     */
    public function getPosts()
    {

        $url = strval($this->base_url . $this->frontpage_url);

        $this->index($url, ".Post")
            ->each(function (Crawler $node) {

                $title = $node->filter("._eYtD2XCVieq6emjKBH3m")->text();

                // Bug: always returns null TODO: get image, videos, gifs here
                if(strpos($node->text(), ".ImageBox-image.media-element")){
                    $image_src = $node->filter(".ImageBox-image.media-element")->attr("src") || NULL;
                }
                else
                {
                    $image_src = NULL;
                }

                $subreddit_text = $node->filter('a[data-click-id="subreddit"]')->attr("href");
                $subreddit = preg_replace(["|r|", "|/|"], "", $subreddit_text);

                $subreddit_link = $this->base_url . $node->filter('a[data-click-id="subreddit"]')->attr("href");

                $user = $node->filter('.oQctV4n0yUb0uiHDdGnmE')->text();

                $user_link = $this->base_url . $node->filter('.oQctV4n0yUb0uiHDdGnmE')->attr("href");

                $upvotes = $node->filter("._1rZYMD_4xY3gRcSS3p8ODO")->text();
                $comment_count = $node->filter(".FHCV02u6Cp2zYL0fhQPsO")->text();

                $comment_link = $this->base_url . $node->filter('a[data-click-id="comments"]')->attr("href");

                if(strpos($node->text(), "._2INHSNB8V5eaWp4P0rY_mE"))
                {
                    $link = $node->filter("._2INHSNB8V5eaWp4P0rY_mE")->attr("href");
                }
                else
                {
                    $link = $comment_link;
                }

                $post = Post::updateOrCreate([
                    "title" => $title,
                    "link" => $link,
                    "image_src" => $image_src,
                    "subreddit" => $subreddit,
                    "subreddit_link" => $subreddit_link,
                    "user" => $user,
                    "user_link" => $user_link,
                    "upvotes" => $upvotes,
                    "comment_count" => $comment_count,
                    "comment_link" => $comment_link
                ]);

                print_r($post);
                echo PHP_EOL;

            });

            print("Done.");

    }

}
