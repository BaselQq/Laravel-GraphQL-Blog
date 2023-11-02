<?php

namespace App\GraphQL\Queries;

use App\Models\Role;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserRolesQuery extends Query {

    protected $attributes = [
        'name' => 'userRoles'
    ];

    public function type(): GraphQLType {
        return Type::listOf(GraphQL::type('UserRole'));
    }

    public function resolve($root, $args) {
        // TODO: logic to add authentication
        return Role::all();
    }
}
