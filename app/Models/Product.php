<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Product extends Model
{
    use HasFactory;
    public function getCreatedAtAttribute(){
        return  Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
    public function getUpdatedAtAttribute(){
        return  Carbon::parse($this->attributes['updated_at'])->format('d-m-Y');
    }
}
