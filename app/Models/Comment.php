<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

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
}
