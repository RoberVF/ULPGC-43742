<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WallPost extends Model
{
    protected $fillable = ['user_id', 'message', 'pinned'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(WallPostLike::class);
    }

    public function isLikedBy(int $userId): bool
    {
        return $this->likes->contains('user_id', $userId);
    }
}
