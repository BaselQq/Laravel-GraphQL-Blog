<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class testUserRolePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:userdata';

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
     $Role = new Role;
     $Role->name = "new role";
//     $Role->photo_name = "";
     $Role->save();

     $User = User::find(1);
     $User->roles()->attach($Role->id);
     return collect($User->roles->sortByDESC('created_at'));
    }
}
