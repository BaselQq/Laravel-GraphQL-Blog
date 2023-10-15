<?php

namespace App\GraohQL\Mutations\Category;

use App\Models\Category;
use App\Models\Quest;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;

class DeleteCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteCategory',
        'description' => 'deletes a category'
    ];

    public function type(): Type {
        return Type::boolean();
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
        $category = Category::query()->findOrFail($args['id']);

        return (bool) $category->delete();
    }
}
