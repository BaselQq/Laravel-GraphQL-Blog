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
        $category = new Category();
        $category->title = "fjfj";
//        $category->user_id = 123;
        $category->user_id = 3;
        $category->save();

    }
}
