<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\Pesanan;
use App\PesananDetail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id){
        $buku = Buku::where('id',$id)->first();
        return view('pesan', compact('buku')); 
    }
    public function pesan(Request $request, $id){
        $buku = Buku::where('id',$id)->first();
        $tanggal = Carbon::now();
        
        //cek jumlah maksimal stok pesan
        if($request->jumlah_pesan > $buku->stok){
            return redirect('pesan/'.$id);
        }
        
        //cek apakah data di tabel pesanan sudah ada
        $cek_pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status','0')->first();
        if(empty($cek_pesanan)){
            //simpan ke table pesanans
            $pesan = new Pesanan();
            $pesan->user_id = Auth::user()->id;
            $pesan->tanggal = $tanggal;
            $pesan->status = '0';
            $pesan->kode = mt_rand(100, 999);
            $pesan->jumlah_harga = $buku->harga*$request->jumlah_pesan;
            $pesan->save();
        }else{
            //update jumlah haraga di table pesanan
            $pesan = Pesanan::where('user_id',Auth::user()->id)->where('status','0')->first();
            $pesan->jumlah_harga = $pesan->jumlah_harga+$buku->harga*$request->jumlah_pesan;
            $pesan->update();
        }

        //ambil id pesanan yang sesuai user login
        $pesanan_baru = Pesanan::where('user_id',Auth::user()->id)->where('status','0')->first();
        
        //cek apakah data di tabel pesanan_detail sudah ada
        $cek_pesanan_detail = PesananDetail::where('buku_id',$buku->id)->where('pesanan_id',$pesanan_baru->id)->first();
        if(empty($cek_pesanan_detail)){
            //simpan ke table pesanan_details
            $pesanan_detail = new PesananDetail();
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->buku_id = $buku->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $buku->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        }else{
            $pesanan_detail = PesananDetail::where('buku_id',$buku->id)->where('pesanan_id',$pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;
            //jumlah harga baru diinputkan oleh user
            $harga_pesanan_detail_baru = $buku->harga*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }
        
        return redirect('home');
    }
    public function cek_out(){
        $pesanan = Pesanan::where('user_id',Auth::user()->id)->where('status','0')->first();
        if(!empty($pesanan)){
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }else{
            $pesanan_details = null;
        }
        return view('cek_out', compact('pesanan','pesanan_details'));
    }
    public function delete($id){
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesanan_detail->jumlah_harga;
        $pesanan->update();

        $pesanan_detail->delete();

        return redirect('cek-out');
    }
    public function konfirmasi(){
        $user = User::where('id', Auth::user()->id)->first();
        if(empty($user->alamat)){
            return redirect('profile');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', '0')->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id',$pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $buku = Buku::where('id', $pesanan_detail->buku_id)->first();
            $buku->stok = $buku->stok-$pesanan_detail->jumlah;
            $buku->update();
        }
        return redirect('history/'.$pesanan_id);
    }
    public function edit($id){
        $pesanan_detail = PesananDetail::where('id', $id)->first();
        $buku = Buku::where('id', $pesanan_detail->buku_id)->first();
        return view('edit', compact('pesanan_detail','buku'));
    }
    public function update(Request $request, $id){
        $pesanan_detail = PesananDetail::where('id', $id)->first();
        $buku = Buku::where('id', $pesanan_detail->buku_id)->first();

        $pesanan_detail->jumlah = $request->jumlah_pesan;
        $harga_pesanan_detail_baru = $buku->harga*$request->jumlah_pesan;
        $pesanan_detail->jumlah_harga = $harga_pesanan_detail_baru;

        $pesanan_detail->update();

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $harga_pesanan_detail_baru;
        $pesanan->update();

        return redirect('cek-out');
    }
}
