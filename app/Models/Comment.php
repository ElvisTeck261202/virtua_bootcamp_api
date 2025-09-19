<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illumunate\Database\Eloquent\Relations\BelongstTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'comment',
        'post_uuid'
    ];

    protected $hidden = [
        'id'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_uuid', 'uuid');
    }
}
