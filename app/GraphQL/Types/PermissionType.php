<?php

namespace App\GraphQL\Types;

use App\Models\Permission;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class PermissionType extends GraphQLType {

    protected $attributes = [
        'name' => 'Permission',
        'description' => 'Collection of permissions',
        'model' => Permission::class
    ];

    public function fields() : array {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'ID of permission'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Name of permission'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Permission created at time',
                'resolve' => function (Permission $Object) {
                    return $Object->created_at->getTimestamp();
                }
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Permission updated at time',
                'resolve' => function (Permission $Object) {
                    return $Object->updated_at->getTimestamp();
                }
            ]
        ];
    }
}
