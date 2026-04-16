<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'bill_num';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['bill_num', 'transmitter_dni', 'receiver_dni', 'bill_date', 'total_amount'];
    
    public function transmitter()
    {
        return $this->belongsTo(User::class, 'transmitter_dni', 'dni');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_dni', 'dni');
    }
}
