<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\Reddit;
use Tests\Browser\GlassesUsaScraper;

class RunScraper extends Command
{
    protected $signature = 'scraper:run {name}';
    protected $description = 'Run the specified scraper';

    public function handle()
    {
        $name = $this->argument('name');

        switch ($name) {
            case 'reddit-front-page':
                $scraper = new Reddit();
                break;

            case 'glasses-usa';
                $scraper = new GlassesUsaScraper();
                break;

            default:
                throw new \Exception('Unknown scraper');
        }

        $scraper->run();
    }
}
