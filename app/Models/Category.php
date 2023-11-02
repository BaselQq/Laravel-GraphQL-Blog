<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

//    public function quests() {
//        return $this->hasMany(Quest::class);
//    }

    public function post(): BelongsToMany {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
