@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h3>Riwayat Pemesanan</h3>
                        <table class="table">
                            <tr>
                                <td>No</td>
                                <td>Tanggal</td>
                                <td>Status</td>
                                <td>Total Harga</td>
                                <td>Kode</td>
                                <td>Bayar</td>
                            </tr>
                            <?php $no = 1?>
                            @foreach($pesanans as $pesanan)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$pesanan->tanggal}}</td>
                                    <td>
                                        @if($pesanan->status == 1)
                                            sudah pesan & belum terbayar
                                        @else
                                            sudah terbayar
                                        @endif
                                    </td>
                                    <td>
                                        Rp. {{number_format($pesanan->jumlah_harga)}}
                                    </td>
                                    <td>{{$pesanan->kode}}</td>
                                    <td>
                                        <a href="{{ url('history') }}/{{$pesanan->id}}" class="btn btn-success">Bayar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
