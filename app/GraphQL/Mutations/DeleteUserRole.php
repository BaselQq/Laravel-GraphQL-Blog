<?php

namespace App\GraphQL\Mutations;

use App\Models\Role;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserRole extends Mutation {

    protected $attributes = [
        'name' => 'DeleteUserRole',
        'description' => 'Delete user role by id'
    ];

    public function type(): GraphQLType {
        return Type::boolean();
    }

    public function args(): array {
        return [
            'roleId' => [
                'name' => 'roleId',
                'description' => 'User role id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args) {
        $Role = Role::query()->findOrFail($args['roleId']);

        return (bool) $Role->delete();
    }
}
