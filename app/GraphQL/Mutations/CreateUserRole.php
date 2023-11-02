<?php

namespace App\GraphQL\Mutations;

use App\Models\Role;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateUserRole extends Mutation {

    protected $attributes = [
        'name' => 'createUserRole',
        'description' => 'Create new user role'
    ];

    public function type() : Type {
        return Type::listOf(GraphQL::type('UserRole'));
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool {
        return Auth::guard('api')->check();
    }

    public function args() : array {
        return [
            'roleName' => [
                'name' => 'roleName',
                'type' => Type::nonNull(Type::string())
            ],
            'rolePhotoName' => [
                'name' => 'rolePhoto',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args) {
        $Role = new Role;
        $Role->name = $args['roleName'];
        $Role->photo_name = "";
        $Role->save();

        $User = User::find(Auth::guard('api')->user()->id);
        $User->roles()->attach($Role->id);
        return $User->roles->sortByDESC('created_at');
    }
}
