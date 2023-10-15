<?php

namespace App\GraohQL\Mutations\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateCategory',
        'description' => 'Updates a category'
    ];

    public function type(): GraphQLType {
        return GraphQL::type('Category');
    }

    public function args() : array {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args) {
        $category = Category::query()->findOrFail($args['id']);
        $category->fill($args);
        $category->save();

        return $category;
    }
}
