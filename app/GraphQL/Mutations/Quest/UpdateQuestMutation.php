<?php

namespace App\GraphQL\Mutations\Quest;

use App\Models\Quest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateQuestMutation extends Mutation {

    protected $attributes = [
        'name' => 'updateQuest',
        'description' => 'Updates a quest'
    ];

    public function type(): Type {
        return GraphQL::type('Quest');
    }

    public function args(): array {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string()
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string()
            ],
            'reward' => [
                'name' => 'reward',
                'type' => Type::int()
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::int(),
                'rules' => ['exists:categories,id']
            ]
        ];
    }

    public function resolve($root, $args) {
        $quest = Quest::query()->findOrFail($args['id']);
        $quest->fill($args);
        $quest->save();

        return $quest;
    }

}
