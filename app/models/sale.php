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
    
 ];
    
    public function products(){
        return $this->hasMany('App\Models\product');
    }
}
