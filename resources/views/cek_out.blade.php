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
                    <li class="breadcrumb-item active" aria-current="page">Cek Out</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h3>Cek Out</h3>
                            @if(!empty($pesanan))
                            <p class="text-right">Tanggal Pesan : {{$pesanan->tanggal}}</p>
                            <table class="table table-striped">
                                <tr>
                                    <td>No</td>
                                    <td>Cover Buku</td>
                                    <td>Judul Buku</td>
                                    <td>Jumlah</td>
                                    <td>Harga</td>
                                    <td>Jumlah Harga</td>
                                    <td colspan="2" class="text-center">Aksi</td>
                                </tr>
                                <?php $no = 1?>
                                @foreach($pesanan_details as $pesanan_detail)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td><img src="{{url('img')}}/{{$pesanan_detail->buku->gambar}}" style="width: 75px;" ></td>
                                    <td>{{$pesanan_detail->buku->judul_buku}}</td>
                                    <td>{{$pesanan_detail->jumlah}} Buku</td>
                                    <td>Rp. {{number_format($pesanan_detail->buku->harga)}}</td>
                                    <td>Rp. {{number_format($pesanan_detail->jumlah_harga)}}</td>
                                    <td>
                                        <form action="{{ url('cek-out') }}/{{$pesanan_detail->id}}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin mau menghapus pesanan ini ?')">Hapus</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{url('edit')}}/{{$pesanan_detail->id}}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" align="right"><strong>Total</strong></span></td>
                                    <td><strong>Rp. {{number_format($pesanan->jumlah_harga)}}</strong></td>
                                    <td>
                                        <a href="{{ url('konfirmasi-cek-out') }}" class="btn btn-success" onclick="return confirm('Anda yakin mau melakukan cek out ?')">Cek Out</a>
                                    </td>
                                </tr>
                            </table>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
