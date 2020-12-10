<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GorBooking;
use App\Gor;

//belum ditambahkan auth
class BookingController extends Controller
{
    public function bookingPerGOR($id_gor){
        $bookings = GorBooking::where('id_gor', $id_gor)->get();
        return response()->json($bookings);
    }

    public function bookingPerHari($id_gor, $hari){
        $bookings = GorBooking::where('id_gor', $id_gor)->where('hari', $hari)->get();
        return response()->json($bookings);
    }

    public function bookingWithNoTransaksi($id_gor, $no_transaksi){
        $bookings = GorBooking::where('id_gor', $id_gor)->where('no_transaksi', $no_transaksi)->first();
        return response()->json($bookings);
    }

    public function addTransaksi($id_gor, Request $request){
        $booking = new GorBooking;
        $data_gor = Gor::where('id', $id_gor)->first();

        $booking->id_pemilik = $data_gor->id_pemilik;
        $booking->nomor_transaksi = NULL; //sementara
        $booking->id_gor = $id_gor; 
        $booking->user_id = $request->input('user_id'); 
        $booking->tanggal = $request->input('tanggal'); 
        $booking->hari = $request->input('hari'); 
        $booking->start_hour = $request->input('start_hour'); 
        $booking->finish_hour = $request->input('finish_hour'); 
        $booking->total = $request->input('total'); 
        $booking->status = "Belum Lunas"; 
        $booking->approval = "Pending";
        $booking->message = "Silahkan Lakukan Pembayaran";
        
        $booking->save();

        if($booking->save()){
            return response()->json('Booking Berhasil', 201);
        }
        else{
            return response()->json('Booking gagal, silahkan coba lagi', 400);
        }
        
    }

    public function updateTransaksi($nomor_transaksi){
        $booking = GorBooking::where('nomor_transaksi', $nomor_transaksi)->first();
        $booking->status = "Lunas";
        $booking->message = "Menunggu Approval dari GOR...";
        $booking->save();

        if($booking->save()){
            return response()->json('Booking Berhasil diupdate', 200);
        }
        else{
            return response()->json('Booking gagal, silahkan coba lagi', 400);
        }
    
    }
    public function updateApproval($nomor_transaksi){
        $booking = GorBooking::where('nomor_transaksi', $nomor_transaksi)->first();
        $booking->approval = $request->input('approval');
        $booking->message = "...";
        $booking->save();

        if($booking->save()){
            return response()->json('Approval update berhasil', 200);
        }
        else{
            return response()->json('gagal', 400);
        }
    }
}
