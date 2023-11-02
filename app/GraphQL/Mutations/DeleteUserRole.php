<?php

namespace App\GraphQL\Mutations;

use App\Models\Role;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserRole extends Mutation {

    protected $attributes = [
        'name' => 'DeleteUserRole',
        'description' => 'Delete user role by id'
    ];

    public function type(): GraphQLType {
        return Type::boolean();
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool {
        return Auth::guard('api')->check();
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
