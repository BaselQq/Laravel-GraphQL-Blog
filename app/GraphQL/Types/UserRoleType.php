<?php

namespace App\GraphQL\Types;

use App\Models\Role;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserRoleType extends GraphQLType{

    protected $attributes = [
        'name' => 'UserRole',
        'description' => 'User role Type',
        'model' => Role::class
    ];

    public function fields() : array {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Role id'
                ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Role Name'
            ],
            // TODO implementation of upload functionality is necessarily
            'photo_name' => [
                'type' => Type::string(),
                'description' => 'Name of role photo file',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Role creation date'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Role last time updated'
            ]
        ];
    }
}