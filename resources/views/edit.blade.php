@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row mb-2">
        <div class="col-md">
            <a href="{{url('home')}}" class="btn btn-primary">Kembali</a>
        </div>
    </div> -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('cek-out')}}">Cek Out</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Pesanan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                <div class="row">
                        <div class="col-md-6">
                            <img src="{{url('img')}}/{{$pesanan_detail->buku->gambar}}" style="width: 75%;" class="rounded mx-auto d-block" srcset="">
                        </div>
                        <div class="col-md-6">
                            <h3 class="mt-5">{{$pesanan_detail->buku->judul_buku}}</h3>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>Rp. {{number_format($pesanan_detail->buku->harga)}}</td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td>{{$pesanan_detail->buku->stok}}</td>
                                </tr>
                                
                                <tr>
                                    <td>Jumlah Pesanan</td>
                                    <td colspan="2">
                                    <form action="{{url('update')}}/{{$pesanan_detail->id}}" method="post">
                                    @method('PUT')
                                    @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="1" name="jumlah_pesan" value="{{$pesanan_detail->jumlah}}">
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Pesan</button>
                                    </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
