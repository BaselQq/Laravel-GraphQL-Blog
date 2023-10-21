<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'photo_name', 'created_at', 'updated_at'];

    public function user() : BelongsToMany{
        return $this->belongsToMany(User::class, 'user_role');
    }

    public function permissions() : BelongsToMany {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
