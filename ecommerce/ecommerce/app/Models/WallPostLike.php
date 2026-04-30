<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WallPostLike extends Model
{
    protected $fillable = ['user_id', 'wall_post_id'];
}