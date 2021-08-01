<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '1')->get();
        return view('history', compact('pesanans'));
    }
    public function detail($id){
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        return view('history_detail', compact('pesanan','pesanan_details'));
    }
}
