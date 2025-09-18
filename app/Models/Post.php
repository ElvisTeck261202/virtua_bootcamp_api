<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\BelongsTo;

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

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
