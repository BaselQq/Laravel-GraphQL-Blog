<?php

namespace App\Console\Commands;

use App\Models\Permission;
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
    $Role->name = "new role1";
    //     $Role->photo_name = "";
    $Role->save();

    $User = User::find(1);
    $User->roles()->attach($Role->id);

    $Permission = new Permission();
    $Permission->name = 'create';
    $Permission->save();
    $Role->permissions()->attach($Permission);
//    $this->line("{}");
    echo count($Role->permissions);

//    $Permission->name = 'read';
//    $Permission->name = 'update';
//    $Permission->name = 'delete';
//
//    $Role = Role::query()->find('40');
//    $Role->permissions()->attach($Permission);
//
//        return collect($Role->permissions->sortByDESC('created_at'));
    }
}
