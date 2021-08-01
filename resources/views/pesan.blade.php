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
                    <li class="breadcrumb-item active" aria-current="page">Buku</li>
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
                            <img src="{{url('img')}}/{{$buku->gambar}}" style="width: 75%;" class="rounded mx-auto d-block" srcset="">
                        </div>
                        <div class="col-md-6">
                            <h3 class="mt-5">{{$buku->judul_buku}}</h3>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>Rp. {{number_format($buku->harga)}}</td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td>:</td>
                                    <td>{{$buku->stok}}</td>
                                </tr>
                                
                                <tr>
                                    <td>Jumlah Pesanan</td>
                                    <td colspan="2">
                                    <form action="{{url('pesan')}}/{{$buku->id}}" method="post">
                                    @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="1" name="jumlah_pesan">
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
