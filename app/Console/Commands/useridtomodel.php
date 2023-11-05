<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class useridtomodel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'useridtomodel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
            $Category = Category::query()->find(27);

//            $Category->post->limit(2)->get();
//            $Category->post->offset(1);
        dd($Category->post->split(4));
//        echo PHP_EOL;
//        dd($Category->post);
    }
}
