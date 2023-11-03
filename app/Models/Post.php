<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'post_content',
        'post_photo'
    ];

    public function category() : BelongsToMany {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
