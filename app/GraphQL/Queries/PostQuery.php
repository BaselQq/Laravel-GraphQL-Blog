<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PostQuery extends Query {

    protected $attributes = [
        'name' => 'post'
    ];

    public function type(): GraphQLType {
        return GraphQL::type('Post');
    }

    public function args(): array {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args) {
        return Post::query()->findOrFail($args['id']);
    }
}
