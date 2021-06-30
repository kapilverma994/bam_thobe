<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Notification extends Model
{
    use HasFactory;
    protected $table="notifications";
    public function makeNotifiaction($data)
    {
        $data['updated_at'] = now();
        $data['created_at'] = now();

        $query_data =Notification::insertGetId($data);


        return $query_data;
    }
}
