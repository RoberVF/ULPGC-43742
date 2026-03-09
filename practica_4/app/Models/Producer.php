<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $table = 'producers';
    protected $primaryKey = 'dni';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['dni', 'iban', 'cert_ods'];

    public function user()
    {
        return $this->belongsTo(User::class, 'dni', 'dni');
    }
}
