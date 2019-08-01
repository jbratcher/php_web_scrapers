<?php

namespace App\Scrapers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use App\Post;

class Reddit extends Scraper
{
    /**
     * @var string
     */
    protected $base_url = "https://www.reddit.com";

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

        print_r($this->reddit_posts);

        $this->getPosts();

    }

    /**
     * @var array
     *
     * Gets event data for each state and stores it to the Events table
     */
    public function getPosts()
    {

        $posts = [];

        $this->index(strval($this->base_url . $this->frontpage_url), ".Post")
            ->each(function (Crawler $node) {

                print_r($node->text());

                $title = $node->filter("._eYtD2XCVieq6emjKBH3m")->text();
                $link = $node->filter("._2INHSNB8V5eaWp4P0rY_mE")->attr("href");

                // TODO: see if there is another selector being used after Arkansas or if most locations are actually missing
                if(strpos($node->text(), 'img[alt="Post image"]') ){
                    $imagesrc = $node->filter('img[alt="Post image"]')->attr("src");
                }
                else
                {
                    $imagesrc = "http://placehold.it/350x150";
                }

                $subreddit = $node->filter('a[data-click-id="subreddit"]')->text();
                $subredditlink = $node->filter('a[data-click-id="subreddit"]')->attr("href");
                $user = $node->filter('.oQctV4n0yUb0uiHDdGnmE')->text();
                $userlink = $node->filter('.oQctV4n0yUb0uiHDdGnmE')->attr("href");
                $upvotes = $node->filter("._1rZYMD_4xY3gRcSS3p8ODO")->text();
                $commentcount = $node->filter(".FHCV02u6Cp2zYL0fhQPsO")->text();
                $commentlink = $node->filter('a[data-click-id="comments"]')->attr("href");

                $post = Post::updateOrCreate([
                    "title" => $title,
                    "link" => $link,
                    "image-src" => $imagesrc,
                    "subreddit" => $subreddit,
                    "subreddit-link" => $subredditlink,
                    "user" => $user,
                    "user-link" => $userlink,
                    "upvotes" => $upvotes,
                    "comment-count" => $commentcount,
                    "comment-link" => $commentlink
                ]);

                print_r($post);

            });

            print_r($posts);

    }

}
