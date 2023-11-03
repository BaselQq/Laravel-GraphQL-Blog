<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQlType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PostsQuery extends Query {

    protected $attributes = [
        'name' => 'posts'
    ];

    public function type(): GraphQLType {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function resolve($root, $args) {
        return Post::all();
    }
}
