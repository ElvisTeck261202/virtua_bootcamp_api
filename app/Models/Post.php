<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use Uuid;


    protected $table = 'posts';

    protected $fillable = [
        'name',
        'description',
        'user_uuid'
    ];

    protected $hidden = [
        'id'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_uuid', 'uuid');
    }
}
