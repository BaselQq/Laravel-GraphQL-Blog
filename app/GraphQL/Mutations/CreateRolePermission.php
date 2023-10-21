<?php

namespace App\GraphQL\Mutations;

use App\Models\Permission;
use App\Models\Role;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateRolePermission extends Mutation {

    protected $attributes = [
        ''
    ];

    public function type(): GraphQLType {
        return GraphQL::type('UserRole');
    }

    public function args(): array {
        return [
            'roleId' => [
                'name' => 'roleId',
                'type' => Type::nonNull(Type::int())
            ],
            'permissions' => [
                'name' => 'permissions',
                'type' => Type::listOf(GraphQL::type('PermissionEnum'))
            ]
        ];
    }

    public function resolve($root, $args) {
        $permissions = $args['permissions'];
        $Role = Role::find($args['roleId']);

        foreach ($permissions as $permission) {
            $Permission = new Permission();
            $Permission->name = $permission;
            $Permission->save();
            $Role->permissions()->attach($Permission);
        }

        return $Role;
    }
}
