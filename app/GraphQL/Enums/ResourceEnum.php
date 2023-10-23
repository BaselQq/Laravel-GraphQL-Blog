<?php

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class ResourceEnum extends EnumType {

    protected $attributes = [
        'name' => 'resource',
        'description' => 'Resource type',
        'values' => [
            'POST' => 'post',
            'COMMENT' => 'comment'
        ]
    ];

}
