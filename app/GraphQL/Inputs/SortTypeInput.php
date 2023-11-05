<?php

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\InputType;

class SortTypeInput extends InputType {

    protected $attributes = [
        'name' => 'SortTypeInput',
        'description' => 'Sort by ASC or DESC'
    ];

    public function fields(): array {
        return [
            'sortBy' => [
                'name' => 'sortBy',
                'description' => 'Sort by ASC or DESC',
                'type' => GraphQL::type('SortTypeEnum')
            ],
        ];
    }

}
