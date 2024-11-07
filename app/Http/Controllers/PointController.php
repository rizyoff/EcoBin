<?php

namespace App\Http\Controllers;

use App\Models\point;
use App\Http\Requests\StorepointRequest;
use App\Http\Requests\UpdatepointRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah' => 'required|string',
            'berat' => 'required|numeric',
        ]);

        $userId = Auth::user()->id;
        $jenisSampah = $request->input('jenis_sampah');
        $berat = $request->input('berat');


        $totalPoint = 0;

        if($jenisSampah == 'anorganik'){
            $totalPoint = $berat * 2000;
        }
        else{
            $totalPoint = $berat * 1000;
        }


        $point = Point::where('user_id', $userId)->first();

        if ($point) {
            $point->point += $totalPoint;
            $point->save();
        } else {

            Point::create([
                'user_id' => $userId,
                'point' => $totalPoint,
            ]);
        }


        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }


    public function reedemPoint(Request $request)
    {
        // Dapatkan user ID dan poin yang dimiliki
        $user = Auth::user();
        $point = Point::where('user_id', $user->id)->first();

        // Nominal penukaran yang diminta
        $nominalPenukaran = $request->input('nominal');

        // Cek apakah poin cukup
        if ($point && $point->point >= $nominalPenukaran) {
            // Kurangi poin
            $point->point -= $nominalPenukaran;
            $point->save();

            return redirect()->route('reedem')->with([
                'status' => 'success',
                'message' => 'Penukaran berhasil!']);
        }else{
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Poin tidak cukup.']);
        }
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}

