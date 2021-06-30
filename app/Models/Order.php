<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Order extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class,'token','token');
    }
    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function customer_address(){
        return $this->belongsTo(Address::class,'address_id','id');
    }



    public function getCreatedAtAttribute(){
        return  Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
    public function getUpdatedAtAttribute(){
        return  Carbon::parse($this->attributes['updated_at'])->format('d-m-Y');
    }
    public function customer_gift_cart(){
        return $this->belongsTo(Gift_cart::class,'gift_id','gift_id');
    }
    public function custom_cart(){
        return $this->belongsTo(Thobe_cart::class,'thobe_id');
    }
}
