<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gor;
use App\GorSchedule;

class GorController extends Controller
{
    public function all(){
        $gors = Gor::all();
        return response()->json($gors);
    }

    public function show($id_gor){
        $gor = Gor::find($id_gor);
        return response()->json($gor);
    }

    public function location(Request $request){
        $location = $request->kota;
        $gor = Gor::where('kota', $location)->first();
        return response()->json($gor);
    }

    public function add(Request $request){
        $gor = New Gor;
        $gor->id_pemilik = $request->input('id_pemilik');
        $gor->id_kategori = $request->input('id_kategori');
        $gor->nama = $request->input('nama');
        $gor->desc = $request->input('desc');
        $gor->telp = $request->input('telp');
        $gor->imgUrl = $request->input('imgUrl');
        $gor->kota = $request->input('kota');
        $gor->alamat_lengkap = $request->input('alamat_lengkap');
        $gor->harga_per_jam = $request->input('harga_per_jam');
        $gor->save();

        $jadwal = New GorSchedule;
        $jadwal->id_gor = $gor->id;
        $jadwal->hari = "Senin";
        $jadwal->open_hour = "00:00";
        $jadwal->close_hour = "00:00";
        $jadwal->save();

        $jadwal = New GorSchedule;
        $jadwal->id_gor = $gor->id;
        $jadwal->hari = "Selasa";
        $jadwal->open_hour = "00:00";
        $jadwal->close_hour = "00:00";
        $jadwal->save();

        $jadwal = New GorSchedule;
        $jadwal->id_gor = $gor->id;
        $jadwal->hari = "Rabu";
        $jadwal->open_hour = "00:00";
        $jadwal->close_hour = "00:00";
        $jadwal->save();

        $jadwal = New GorSchedule;
        $jadwal->id_gor = $gor->id;
        $jadwal->hari = "Kamis";
        $jadwal->open_hour = "00:00";
        $jadwal->close_hour = "00:00";
        $jadwal->save();

        $jadwal = New GorSchedule;
        $jadwal->id_gor = $gor->id;
        $jadwal->hari = "Jumat";
        $jadwal->open_hour = "00:00";
        $jadwal->close_hour = "00:00";
        $jadwal->save();

        $jadwal = New GorSchedule;
        $jadwal->id_gor = $gor->id;
        $jadwal->hari = "Sabtu";
        $jadwal->open_hour = "00:00";
        $jadwal->close_hour = "00:00";
        $jadwal->save();

        $jadwal = New GorSchedule;
        $jadwal->id_gor = $gor->id;
        $jadwal->hari = "Minggu";
        $jadwal->open_hour = "00:00";
        $jadwal->close_hour = "00:00";
        $jadwal->save();


        if($gor->save()){
            return response()->json('Data berhasil dibuat', 201);
        }

        else{
            return response()->json("Gagal membuat data", 400);
        }
    }

    public function update(Request $request){
        $gor = Gor::where('id', $request->input('id'))->first();
        $gor->id_kategori = $request->input('id_kategori');
        $gor->nama = $request->input('nama');
        $gor->desc = $request->input('desc');
        $gor->imgUrl = $request->input('imgUrl');
        $gor->kota = $request->input('kota');
        $gor->alamat_lengkap = $request->input('alamat_lengkap');
        $gor->harga_per_jam = $request->input('harga_per_jam');

        $gor->save();

        if($gor->save()){
            return response()->json('Data berhasil diubah', 200);
        }

        else{
            return response()->json("Gagal mengubah data", 400);
        }
    }

    public function delete(Request $request){
        $jadwal = GorSchedule::where('id_gor', $request->input('id_gor'))->delete();
        $gor = Gor::where('id', $request->input('id_gor'))->first();

        $gor->delete();

        return response()->json('Deleted', 200);
    }
}
