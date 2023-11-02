<?php

namespace App\GraphQL\Queries;

use App\Models\Role;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserRoleQuery extends Query {

    protected $attributes = [
        'name' => 'userRole'
    ];

    public function type(): Type {
        return GraphQL::type('UserRole');
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool {
        return Auth::guard('api')->check();
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
