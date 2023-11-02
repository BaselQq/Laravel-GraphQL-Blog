<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;

class fetch_role_users extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch_role_users';

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
        $Role = Role::query()->findOrFail(112);
//        $Role->permissions()->updateOrCreate(['name' => 'bla4', 'resource' => 'post'], ['name' => 'bla4']);

        $permissions = ['create', 'read', 'delete'];

        foreach ($permissions as $permission) {
            $Role->permissions()->upsert([
                ['resource' => 'post', 'name' => $permission],
            ],
                ['resource', 'name'],
                ['name']
            );
        }
        dd($Role);
    }
}
