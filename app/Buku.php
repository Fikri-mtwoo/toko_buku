<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    //
    public function pesanan_detail(){
        return $this->hasMany('App\PesananDetail','buku_id','id');
    }
}
