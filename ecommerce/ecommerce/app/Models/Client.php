<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'dni';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['dni'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dni', 'dni');
    }
}
