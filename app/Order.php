<?php

namespace App;

use App\Models\Charge;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    // protected $casts = [
    //     'order_products' => 'array'
    // ];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity', 'price', 'variation');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function status($key = 0)
    {
        return [
            0 =>    'غير مؤكد',
            1 =>    'مؤكد',
            2 =>    'ملغى',
            3 =>    'تحت التنفيذ',
            4 =>    'تم الإنتهاء'
        ][$key];
    }
    public function paymentStatus($key = 0)
    {
        return [
            0 => 'غير مدفوع',
            1 => 'مدفوع',
            2 => 'مدفوع جزئي'
        ][$this->payment_status];
    }

    public function charges()
    {
        return $this->hasMany(Charge::class)->latest();
    }

    public function bill()
    {
        if ($this->type == 0) {
            return $this->total;
        } elseif ($this->type == 1) {
            return  $this->charges()->where('status', 0)->first()->amount ?? 0;
        }
        return 0;
    }

    public function paid()
    {
        if ($this->type == 0) {
            if ($this->status == 0) {
                return 0;
            }
            return $this->total;
        }
        return  $this->charges()->where('status', 1)->sum('amount') ?? 0;
    }
    public function due()
    {
        if ($this->type == 0) {
            if ($this->status == 0) {
                return $this->total;
            }
            return 0;
        }
        return $this->total - $this->charges()->where('status', 1)->sum('amount')  ?? $this->total;
    }
}
