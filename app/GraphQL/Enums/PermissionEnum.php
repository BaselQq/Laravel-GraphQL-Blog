<?php

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class PermissionEnum extends EnumType {

    protected $attributes = [
        'name' => 'permission',
        'description' => 'Permissions CRUD enums',
        'values' => [
            'NONE' => null,
            'CREATE' => 'create',
            'READ' => 'read',
            'UPDATE' => 'update',
            'DELETE' => 'delete'
        ]
    ];

}
