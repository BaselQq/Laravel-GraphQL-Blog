<?php

namespace App\GraphQL\Enums;

use Rebing\GraphQL\Support\EnumType;

class SortTypeEnum extends EnumType {

    protected $attributes = [
        'name' => 'sort',
        'description' => 'Sorting data by asc or desc',
        'values' => [
            'ASC',
            'DESC',
        ]
    ];
}
