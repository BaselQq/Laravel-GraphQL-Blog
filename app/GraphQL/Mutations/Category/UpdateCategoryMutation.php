<?php

namespace App\GraphQL\Mutations\Category;

use App\Models\Category;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateCategoryMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateCategory',
        'description' => 'Updates a category'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool {
        return Auth::guard('api')->check();
    }

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
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
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
