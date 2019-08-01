<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Scrapers\Reddit;

class RunScraper extends Command
{
    protected $signature = 'scraper:run {name}';
    protected $description = 'Run the specified scraper';

    public function handle()
    {
        $name = $this->argument('name');

        switch ($name) {
            case 'reddit-font-page':
                $scraper = new Reddit();
                break;

            default:
                throw new \Exception('Unknown scraper');
        }

        $scraper->run();
    }
}
