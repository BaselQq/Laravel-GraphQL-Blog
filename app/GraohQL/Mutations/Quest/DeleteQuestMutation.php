<?php

namespace App\GraohQL\Mutations\Quest;

use App\Models\Quest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteQuestMutation extends Mutation {

    protected $attributes = [
        'name' => 'deleteQuest',
        'description' => 'Deletes a quest'
    ];

    public function type(): Type {
        return Type::boolean();
    }

    public function args(): array {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['exists:quests']
            ]
        ];
    }

    public function resolve($root, $args) {
        $category = Quest::query()->findOrFail($args['id']);

        return (bool) $category->delete();
    }
}
