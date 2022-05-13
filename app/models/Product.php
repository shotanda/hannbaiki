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
    'id',
    'company_name',
    'product_name',
    'price',
    'stock',
 ];


public function scopeProductname($query, $str) {
    return $query->where('product_name', $str);
}
public function scopeCompanyname($query, $com) {
    return $query->where('company_name', $com);
}
public function scopeMinprice($query, $q)
{
    return $query->where('price', '>=', $q);
}
public function scopeMaxprice($query, $q)
{
    return $query->where('price','<=', $q);
}

public function sales(){
    return $this->hasMany('App\sale','product_id');
}


}