<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $fillable = ['dni', 'user_id', 'iban', 'cert_ods'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dni', 'dni');
    }
}
