<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GorSchedule;

class JadwalController extends Controller
{
    public function showJadwal($id_gor){
        $jadwal = GorSchedule::where('id_gor', $id_gor)->get();
        return response()->json($jadwal);
    }

    public function jadwalPerHari($id_gor, $hari){
        $jadwal = GorSchedule::where('id_gor', $id_gor)->where('hari', $hari)->first();
        return response()->json($jadwal);
    }

    public function updateJadwal($id_gor, $hari, Request $request){
        $jadwal = GorSchedule::where('id_gor', $id_gor)->where('hari', $hari)->first();
        $jadwal->open_hour = $request->input('open_hour');
        $jadwal->close_hour = $request->input('close_hour');
        $jadwal->save();

        if($jadwal->save()){
            return response()->json('Jadwal berhasil di update', 200);
        }

        else{
            return response()->json("Gagal mengupdate data", 400);
        }
    }
}
