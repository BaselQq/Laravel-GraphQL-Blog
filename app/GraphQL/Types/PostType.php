<?php

namespace App\GraphQL\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQlType;

class PostType extends GraphQlType {

    protected $attributes = [
        'name' => 'Post',
        'description' => 'Collection of Post',
        'model' => Post::class
    ];

    public function fields(): array {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Post id'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Post description'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Post description'
            ],
            'post_content' => [
                'type' => Type::string(),
                'description' => 'Post Content'
            ],
            'post_photo' => [
                'type' => Type::string(),
                'description' => 'Post cover photo'
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'User of post'
            ],
            'category' => [
                'type' => Type::listOf(GraphQL::type('Category')),
                'description' => 'Post categories'
            ]
        ];
    }
}
