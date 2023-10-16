<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class RegisterUserType extends GraphQLType {

    protected $attributes = [
        'name' => 'RegisterUser',
        'description' => 'Register User type'
    ];

    public function fields(): array {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User name for registration'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'User E-Mail for registration'
            ]
        ];
    }

}
