<?php

namespace App\GraphQL\Types;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType {
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Collection of categories',
        'model' => Category::class
    ];

    public function fields(): array {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of quest'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the quest'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Description of the category'
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'Category owned user',
            ],
            'posts' => [
                'type' => Type::listOf(GraphQL::type('Post')),
                'description' => 'Posts of category',
                'resolve' => function (Category $O) {
                    return $O->post;
                }
            ],
            'created_at' => [
                'type' => Type::int(),
                'description' => 'Category created at timestamp',
                'resolve' => function (Category $O) {
                    return $O->created_at->getTimestamp();
                }
            ],
            'updated_at' => [
                'type' => Type::int(),
                'description' => 'Category updated at timestamp',
                'resolve' => function (Category $O) {
                    return $O->created_at->getTimestamp();
                }
            ]
//            'quests' => [
//                'type' => Type::listOf(GraphQL::type('Quest')),
//                'description' => 'List of quests'
//            ]
        ];
    }
}
