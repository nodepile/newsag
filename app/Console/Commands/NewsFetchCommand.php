<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\News\NewsService;

class NewsFetchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(NewsService $newsService)
    {
        $newsService->fetchAll();
    }
}
