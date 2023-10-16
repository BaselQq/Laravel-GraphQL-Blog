<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateUser extends Mutation {

    protected $attributes = [
        'name' => 'createUser',
        'description' => 'Create User mutation'
    ];

    public function type(): GraphQLType {
        return GraphQL::type('RegisterUser');
    }

    public function args(): array {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required']
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'unique:users']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args) {

        $User = new User();
        $User->fill($args)->save();

        $User->createToken('API Token')->accessToken;

        return $User;
    }
}
