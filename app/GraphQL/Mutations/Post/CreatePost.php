<?php

namespace App\GraphQL\Mutations\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreatePost extends Mutation {

    protected $attributes = [
        'name' => 'createPost',
        'description' => 'Create new post'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool {
        return Auth::guard('api')->check();
    }

    public function type(): GraphQLType {
        return GraphQL::type('Post');
    }

    public function args(): array {
        return [
            'categoryId' => [
                'name' => 'categoryId',
                'type' => Type::int()
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'postContent' => [
                'name' => 'postContent',
                'type' => Type::string()
            ],
            'postPhoto' => [
                'name' => 'postPhoto',
                'type' => GraphQL::type('Upload'),
//                'rules' => ['required', 'image', 'max:5000']
            ]
        ];
    }

    public function resolve($root, $args) {
//        $postPhoto = $args['postPhoto'];
        $postContent = $args['postContent'];
        $title = $args['title'];
        $categoryId = $args['categoryId'];
        $User = User::find(Auth::guard('api')->user()->id);

        $Post = new Post();
        $Post->title = $title;

        if (isset($args['description'])) {
            $Post->description = $args['description'];
        }

        $Post->user_id = $User->id;

        $Post->post_content = $postContent;
        $Post->save();

        $targetedCategory = Category::query()->findOrFail($categoryId);
        $targetedCategory->post()->attach($Post->id);
        return $Post;
    }
}
