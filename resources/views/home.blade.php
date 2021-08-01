@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($bukus as $buku)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{'img'}}/{{$buku->gambar}}" style="width: 65%;" class="rounded mx-auto d-block card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$buku->judul_buku}}</h5>
                        <strong>Harga       : Rp. </strong> {{ number_format($buku->harga)}} <br>
                        <strong>Stok        : </strong> {{$buku->stok}} <br>
                        <strong>Keterangan  : </strong> {{$buku->keterangan}}
                    </div>
                    <div class="card-footer">
                    <a href="{{url('pesan')}}/{{$buku->id}}" class="btn btn-primary">Pesan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
