# PHP Web Scrapers  

## Larvel Dusk, Laravel Goutte, and PHP Simple HTML DOM Parser

#### Reddit example using Goutte
laravel-examples\app\Scrapers\Reddit.php

#### GlassesUSA example using Dusk
laravel-examples\tests\Browser\GlassesUsaScraperTest.php

Using php to scrape the web for data and provide a view in the browser.  

This repo contains example of how to use various php libraries and frameworks to scrape data from the web.  The original design is based on scraping the reddit.com website.  This is an example of a somewhat challenging website to scrape for data.  

The Dusk example is a little more practical scraping product information from glassesusa.com to create a database table fo the frames.

[Laravel Dusk](https://github.com/laravel/dusk)
[Goutte with Laravel](https://github.com/FriendsOfPHP/Goutte)
[PHP Simple HTML DOM Parser](https://simplehtmldom.sourceforge.io/)    

Scrape front page and subreddit posts on reddit including title, img, and link (Aggregation)  

Scrape product catalog to generate a for sale listing (name, product ID, price, brands, styles, etc.).  (E-commerce)  

Creating usable objects via web scraping for data to display on the front end.  
  


Note:  The website choice may be changed later, as I didn't fully understand that scraping Reddit specifically was something the site was developed to thwart. For example, the site uses generated class names that (I assume) change periodically and will break a fragile scraper that targets selector based on class name only.