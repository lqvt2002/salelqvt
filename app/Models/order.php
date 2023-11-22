<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'order';
    public $timestamps = false; //ví k có thuộc tính created và updated nên ẩn nó đi

    protected $fillable = [
        'name', 'email'	,'phonenumber', 'address','note', 'order_date', 'status'	, 'totalmoney', 'user_id'
    ];
}
