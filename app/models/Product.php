<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     //テーブル名
     protected $table='Products';
     //可変項目
     protected $fillable=
 [   
    'company_name',
    'street_address',
    'product_name',
    'price',
    'stock',
    'comment'
 ];
}
