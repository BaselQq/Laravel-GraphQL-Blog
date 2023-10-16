<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserLoginQuery extends Query {

    protected $attributes = [
        'name' => 'UserLoginQuery'
    ];

    public function type(): Type {
        return GraphQL::type('User');
    }

    public function args(): array {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'description' => 'User email to login',
                'rules' => 'required'
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'description' => 'User password to login',
                'rules' => 'required'
            ]
        ];
    }

    public function resolve($root, $args) {

        $User = User::query()->where('email', $args['email'])->first();
        if (! $User || ! Hash::check($args['password'], $User->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

//        $token = $User->createToken('API Token')->accessToken;

        return  $User;

//        return collect([
//            'user' => $User,
//            'token' => $User->createToken('API Token')->accessToken
//        ]);

//        if(!auth()->attempt($args)) {
//            return response(
//                ['email' => ['The provided credentials are incorrect.']
//            ]);
//        }
//
//        $token = auth()->user()->createToken('API Token')->accessToken;
//
//        return response([
//            'user' => auth()->user(),
//            'token' => $token
//        ]);
    }

}
