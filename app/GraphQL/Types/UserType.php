<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType {

    protected $attributes = [
        'name' => 'User',
        'description' => 'User Query',
        'model' => User::class
    ];

    public function fields(): array {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'User id'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Username'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User E-Mail'
            ],
            'remember_token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User Login Token',
                'resolve' => function (User $user) {
                    return $user->createToken('API Token')->accessToken;
                }
            ]
        ];
    }

}
