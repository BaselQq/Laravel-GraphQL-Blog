<?php

namespace App\GraphQL\Mutations;

use App\Models\Role;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserRole extends Mutation {

    protected $attributes = [
        'name' => 'UpdateUserRole',
        'description' => 'Update User Roles by id'
    ];

    public function type(): GraphQLType {
        return GraphQL::type('UserRole');
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool {
        return Auth::guard('api')->check();
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
        // TODO: adding Gates is necessarily
        $Role = Role::find($args['roleId']);
        $Role->name = $args['roleName'];
        $Role->save();

        return $Role;
    }
}
