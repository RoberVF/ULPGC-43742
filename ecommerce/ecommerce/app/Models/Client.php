<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['dni', 'user_id', 'birth_date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dni', 'dni');
    }
}
