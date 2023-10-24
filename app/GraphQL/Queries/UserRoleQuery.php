<?php

namespace App\GraphQL\Queries;

use App\Models\Role;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserRoleQuery extends Query {

    protected $attributes = [
        'name' => 'userRole'
    ];

    public function type(): Type {
        return GraphQL::type('UserRole');
    }

    public function args() : array {
        return [
            'id' => [
                'name' => 'id',
                'description' => 'Role id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args) {
        return Role::query()->findOrFail($args['id']);
    }

}
