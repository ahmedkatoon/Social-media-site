<?php

namespace App\Console\Commands;

use App\Models\Story;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class DeleteOldStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-stories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete stories older than 1 hour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stories = Story::all();

        foreach($stories as $story){
            if($story->created_at->diffInHours(Carbon::now())>1){
                $story->delete();
            }
        }
    }
}
