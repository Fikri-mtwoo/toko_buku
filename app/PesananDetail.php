<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    //
    public function pesanan(){
        return $this->belongsTo('App\Pesanan','pesanan_id','id');
    }
    public function buku(){
        return $this->belongsTo('App\Buku','buku_id','id');
    }
}
