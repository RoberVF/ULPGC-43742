<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetails extends Model
{
    protected $table = 'bill_details';
    protected $primaryKey = ['bill_num', 'harvest_id'];
    public $incrementing = false;
    protected $fillable = ['bill_num', 'harvest_id', 'quantity', 'price'];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_num', 'bill_num');
    }

    public function harvest()
    {
        return $this->belongsTo(Harvest::class, 'harvest_id', 'id');
    }
}
