<?php

namespace App\GraphQL\Mutations\Category;

use App\Models\Category;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'createCategory',
        'description' => 'Create a category'
    ];

    public function type(): GraphQLType {
        return GraphQL::type('Category');
    }

    public function args(): array {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args) {
        $category = new Category();
        $category->fill($args);
        $category->save();

        return $category;
    }
}
