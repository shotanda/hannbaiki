<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    ///テーブル名
    protected $table = 'sales';

    ///可変項目
     //可変項目
     protected $fillable=
 [   
    'id',
    'product_id'
 ];
    
    public function product(){
        return $this->belongsTo('App\product');
    }
}
