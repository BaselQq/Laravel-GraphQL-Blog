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
        'name' => 'createRolePermissions',
        'description' => 'Create permissions for specific role'
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
            ],
            'resource' => [
                'name' => 'resource',
                'type' => Type::listOf(GraphQL::type('ResourceEnum'))
            ]
        ];
    }

    public function resolve($root, $args) {
        $Role = Role::find($args['roleId']);
        $permissions = $args['permissions'];
        $resources = $args['resource'];

        foreach ($permissions as $permission) {
            foreach ($resources as $resource) {
                $Permission = new Permission();
                $Permission->name = $permission;
                $Permission->resource = $resource;
                $Permission->save();
                $Role->permissions()->attach($Permission);
            }
        }

        return $Role;
    }
}
