<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';
    protected $primaryKey = 'dni';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['dni', 'iban'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dni', 'dni');
    }
}
