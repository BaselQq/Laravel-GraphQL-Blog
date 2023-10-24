<?php

namespace App\GraphQL\Mutations;

use App\Models\Role;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserRole extends Mutation {

    protected $attributes = [
        'name' => 'UpdateUserRole',
        'description' => 'Update specific User Roles'
    ];

    public function type(): GraphQLType {
        return GraphQL::type('UserRole');
    }

    public function args(): array {
        return [
            'roleId' => [
                'name' => 'roleId',
                'description' => 'Role id',
                'type' => Type::nonNull(Type::int())
            ],
            'roleName' => [
                'name' => 'roleName',
                'description' => 'Role name',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args) {
        $Role = Role::find($args['roleId']);
        $Role->name = $args['roleName'];
        $Role->save();

        return $Role;
    }
}
