@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('history')}}">Riwayat Pemesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="alert alert-success" role="alert">
                <h6>Pesanan anda sudah berhasil dicek out selanjutnya untuk pembayaran silahkan pilih metode pembayar</6>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h3>Detail Pemesanan</h3>
                    @if(!empty($pesanan))
                            <p class="text-right">Tanggal Pesan : {{$pesanan->tanggal}}</p>
                            <table class="table table-striped">
                                <tr>
                                    <td>No</td>
                                    <td>cover Buku</td>
                                    <td>Judul Buku</td>
                                    <td>Jumlah</td>
                                    <td>Harga</td>
                                    <td>Jumlah Harga</td>
                                </tr>
                                <?php $no = 1?>
                                @foreach($pesanan_details as $pesanan_detail)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td><img src="{{url('img')}}/{{$pesanan_detail->buku->gambar}}" style="width: 75px;"></td>
                                    <td>{{$pesanan_detail->buku->judul_buku}}</td>
                                    <td>{{$pesanan_detail->jumlah}} Buku</td>
                                    <td>Rp. {{number_format($pesanan_detail->buku->harga)}}</td>
                                    <td>Rp. {{number_format($pesanan_detail->jumlah_harga)}}</td>
                                    
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" align="right"><strong>Total harga</strong></span></td>
                                    <td><strong>Rp. {{number_format($pesanan->jumlah_harga)}}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="right"><strong>Total yang harus ditransfer</strong></span></td>
                                    <td><strong>Rp. {{number_format($pesanan->jumlah_harga)}}</strong></td>
                                </tr>
                            </table>
                            @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3>Detail Pemesan</h3>
                    <table class="table">
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>:</td>
                            <td>{{$pesanan->user->name}}</td>
                        </tr>
                        <tr>
                            <td>Alamat Pemesan</td>
                            <td>:</td>
                            <td>{{$pesanan->user->alamat}}</td>
                        </tr>
                        <tr>
                            <td>No Handpone Pemesan</td>
                            <td>:</td>
                            <td>{{$pesanan->user->nohp}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h3>Metode Pembayaran</h3>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Bank Tranfer
                            <span class="badge badge-primary badge-pill">12345657</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            OVO
                            <span class="badge badge-primary badge-pill">1232435152</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Dana
                            <span class="badge badge-primary badge-pill">12433653781371</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
@endsection
