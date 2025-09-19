<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illumunate\Database\Eloquent\Relations\BelongstTo;

class Comment extends Model
{
    use Uuid;

    protected $table = 'comments';

    protected $fillable = [
        'comment',
        'post_uuid'
    ];

    protected $hidden = [
        'id',
        'deleted_at'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_uuid', 'uuid');
    }
}
