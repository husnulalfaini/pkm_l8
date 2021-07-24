<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sensor;
use Carbon\Carbon;

class SensorController extends Controller
{
    public function keluar()
    {
        $sensor = Sensor::all();
        return response()->json($sensor);
    }
    
    public function masuk(Request $request)
    {   
        // pengondisian sensor ultrasonik
        $kondisi = $request->input('ultrasonik'); 
        if ($kondisi<160) {
            $hasil='proses Berjalan';
        } 
        else {
            $hasil='proses Selesai';
        }

        // pengolahan jumlah sensor berat
        $total = $request->input('berat1')+$request->input('berat2')+$request->input('berat3')+$request->input('berat4');

        // menghapus seluruh data pada db setiap satu menit
        $hapus = Sensor::where('updated_at', '<', Carbon::now()->subMinutes(1))->get();
        foreach ($hapus as $busek) {
            $busek->delete();
        }

        //proses create data baru
        $sensor = Sensor::create([
                
            'berat1' => $request->input('berat1'),
            'berat2' => $request->input('berat2'),
            'berat3' => $request->input('berat3'),
            'berat4' => $request->input('berat4'),
            'ultrasonik' => $request->input('ultrasonik'),
            'totalberat' => $total,
            'kondisi' => $hasil,
            
        ]);

        if ($sensor) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
                'sensor' => $sensor,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',
            ], 401);
        }
    }

    public function hapus()
    {
        $hapus = Sensor::where('updated_at', '<', Carbon::now()->subMinutes(1))->get();
        foreach ($hapus as $busek) {
            $busek->delete();
        }
    }

    public function cobaultra($id)
    {
        $ultra = Sensor::find($id);
        $kondisi = $ultra->ultrasonik; 
        if ($kondisi<160) {
            $hasil='proses Berjalan';
        } 
        else {
            $hasil='proses Selesai';
        }

        $ultra->kondisi = $hasil;
        $ultra->update();
    }
}
