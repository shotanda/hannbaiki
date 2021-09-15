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

 public function sales(){
return $this->belongsTo('App\Models\sale');
 }

public function order($select)
{
    if($select == 'asc'){
        return $this->orderBy('created_at', 'asc')->get();
    } elseif($select == 'desc') {
        return $this->orderBy('created_at', 'desc')->get();
    } else {
        return $this->all();
    }
}

public function getData()
{
    return $this->id . ': ' . $this->company_name . ' [' . $this->price . '] ' . '(' . $this->stock . ')';
}

public function scopeMinprice($query, $minprice)
{   
        return $query->where('price','', '>=', $minprice);
}

public function scopeMaxprice($query, $maxprice)
{   
        return $query->where('price','', '<=', $maxprice);
}

public function scopeMinstock($query, $minstock)
{   
        return $query->where('stock','', '>=', $minstock);
}

public function scopeMaxstock($query, $maxstock)
{   
        return $query->where('stock','', '<=', $maxstock);
}
}
