<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Order;
class Charge extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function status()
    {
        if($this->status ==1){
            return 'مدفوع';
        }
        return 'غير مدفوع';
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
