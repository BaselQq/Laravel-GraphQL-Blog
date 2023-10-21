<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;

class testPermissionRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetchRolePermissions';

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
        $permissions = ['create', 'read', 'update', 'delete'];
        $Role = Role::query()->find('85');

        foreach ($permissions as $permission) {
            $Permission = new Permission();
            $Permission->name = $permission;
            $Permission->save();
            $Role->permissions()->attach($Permission);
        }

        dd($Role->permissions);
    }
}
