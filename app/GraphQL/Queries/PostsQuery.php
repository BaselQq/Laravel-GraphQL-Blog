<?php

namespace App\GraphQL\Queries;

use App\Models\Category;
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

    public function args(): array {
        return [
            'categoryId' => [
                'type' => Type::int(),
                'description' => 'Posts by category id'
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Limit of posts'
            ],
            'offset' => [
                'type' => Type::int(),
                'description' => 'Offset of posts'
            ],
            'sortBy' => [
                'type' => GraphQL::type('SortTypeInput')
            ],
            // TODO: sorty by type (id etc.)
//            'sortDir' => [
//                'type' => Type::
//            ]
        ];
    }

    public function resolve($root, $args) {
        $limit = $args['limit'] ?? 1;
        $offset = $args['offset'] ?? 0;

        if (isset($args['categoryId'])) {
            $Category = Category::find($args['categoryId']);
            $Posts = $Category->post();

            $Posts->orderBy('id', 'desc');

            return $Posts->limit($limit)->skip($offset)->get();
        }

        return Post::all();
    }
}
