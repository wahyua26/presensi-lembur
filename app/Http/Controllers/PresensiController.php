<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use strtotime;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PresensiExport;
use App\Exports\PresensiKaryawanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\PresensiImport;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('presensi.masuk');
    }

    public function keluar()
    {
        return view('presensi.keluar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        /* $ip = $request->ip(); Dynamic IP address */

        // $ip = '103.145.143.242'; /* Static IP address */
        // $currentUserInfo = Location::get($ip);
        
        $lat = $request->latitude;
        $long = $request->longitude;
        //dd($request, $lat, $long);
        $img = $request->image;
        //$folderPath = "public/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        
        $file = $fileName;
        Storage::put($file, $image_base64);
        //dd('Image uploaded successfully: '.$fileName);

        $timezone = 'Asia/Jakarta';
        $date = new Datetime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');

        $presensi = Presensi::where([
            ['user_npp','=',auth()->user()->npp],
            ['tgl','=',$tanggal],
        ])->first();
        if ($presensi){
            return redirect('presensi-masuk')->with('fail', 'Sudah Melakukan Presensi Masuk!');
        }
        else{
            Presensi::create([
                'user_npp' => auth()->user()->npp,
                'tgl' => $tanggal,
                'jamMasuk' => $localtime,
                'fotoMasuk' => $file,
                'latMasuk' => $lat,
                'longMasuk' => $long,
            ]);
        }
        return redirect('presensi-masuk')->with('success', 'Berhasil Melakukan Presensi Masuk!');
    }

    public function presensiPulang(Request $request)
    {
         /* $ip = $request->ip(); Dynamic IP address */

        //  $ip = '103.145.143.242'; /* Static IP address */
        //  $currentUserInfo = Location::get($ip);
         
         $lat = $request->latitude;
         $long = $request->longitude;

        $img = $request->image;
        //$folderPath = "public/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        
        $file = $fileName;
        Storage::put($file, $image_base64);

        $timezone = 'Asia/Jakarta';
        $date = new Datetime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        $localtime = $date->format('H:i:s');

        $presensi = Presensi::where([
            ['user_npp','=',auth()->user()->npp],
            ['tgl','=',$tanggal],
        ])->first();

        if($presensi == null){
            return redirect('presensi-masuk')->with('fail', 'Anda Belum Melakukan Presensi Masuk!');
        }
        
        //dd(date('H:i:s', strtotime($localtime)-strtotime($presensi->jamMasuk)));
        $dt=[
            'tugas' => $request->tugas,
            'jamKeluar' => $localtime,
            'fotoKeluar' => $file,
            'latKeluar' => $lat,
            'longKeluar' => $long,
            'lamaLembur' => date('H:i:s', strtotime($localtime) - strtotime($presensi->jamMasuk))
        ];

        if($presensi->jamKeluar == ""){
            $presensi->update($dt);
            return redirect('presensi-masuk')->with('success', 'Berhasil Melakukan Presensi Keluar!');
        }
        else{
            return redirect('presensi-masuk')->with('fail', 'Sudah Melakukan Presensi Keluar!');
        }
    }
    
    public function tampilanHalamanDataKaryawan()
    {
        $timezone = 'Asia/Jakarta';
        $date = new Datetime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');
        //dd($tanggal);
        return view('presensi.halaman-rekap-karyawan', ['tanggal'=> $tanggal]);
    }

    public function tampilanDataKaryawan($tglAwal, $tglAkhir, $npp)
    {
        $presensi = DB::table('users')
                        ->join('presensi', 'users.npp', '=', 'presensi.user_npp')
                        ->select('users.name', 'users.npp', 'presensi.*')
                        ->where('users.npp',$npp)
                        ->whereBetween('tgl',[$tglAwal, $tglAkhir])
                        ->orderBy('tgl', 'asc')
                        ->get();
        return view('presensi.rekap-karyawan', ['presensi' => $presensi, 'tglAwal' => $tglAwal, 'tglAkhir' => $tglAkhir]);
    }

    public function tampilanHalamanDataKeseluruhan()
    {
        $timezone = 'Asia/Jakarta';
        $date = new Datetime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');

        return view('presensi.halaman-rekap-keseluruhan', ['tanggal' => $tanggal]);
    }

    public function tampilanDataKeseluruhan($tglAwal, $tglAkhir)
    {
        $presensi = DB::table('users')
                        ->join('presensi', 'users.npp', '=', 'presensi.user_npp')
                        ->select('users.name', 'users.npp', 'presensi.*')
                        ->whereBetween('tgl',[$tglAwal, $tglAkhir])
                        ->orderBy('tgl', 'asc')
                        ->get();
        
        //dd($presensi);
        return view('presensi.rekap-keseluruhan', ['presensi' => $presensi, 'tglAwal' => $tglAwal, 'tglAkhir' => $tglAkhir]);
    }

    public function cetakPdfKaryawan($tglAwal, $tglAkhir, $npp)
    {
        $presensi = DB::table('users')
                        ->join('presensi', 'users.npp', '=', 'presensi.user_npp')
                        ->select('users.name', 'users.npp', 'presensi.*')
                        ->where('users.npp',$npp)
                        ->whereBetween('tgl',[$tglAwal, $tglAkhir])
                        ->orderBy('tgl', 'asc')
                        ->get();

        $pdf = PDF::loadview('presensi.presensi_pdf',['presensi'=>$presensi])->setPaper('a4', 'landscape');
	    return $pdf->stream();
    }

    public function cetakPdfKeseluruhan($tglAwal, $tglAkhir)
    {
        $presensi = DB::table('users')
                        ->join('presensi', 'users.npp', '=', 'presensi.user_npp')
                        ->select('users.name', 'users.npp', 'presensi.*')
                        ->whereBetween('tgl',[$tglAwal, $tglAkhir])
                        ->orderBy('tgl', 'asc')
                        ->get();

        $pdf = PDF::loadview('presensi.presensi_pdf',['presensi'=>$presensi])->setPaper('a4', 'landscape');
	    return $pdf->stream();
    }
    
    public function cetakExcelKeseluruhan($tglAwal, $tglAkhir)
    {
        //dd($tglAwal, $tglAkhir);
        return Excel::download(new PresensiExport($tglAwal, $tglAkhir), 'Presensi Keseluruhan.xlsx');
    }

    public function cetakExcelKaryawan($tglAwal, $tglAkhir, $npp)
    {
        return Excel::download(new PresensiKaryawanExport($tglAwal, $tglAkhir, $npp), 'Presensi Karyawan.xlsx');
    }

    public function importExcelKaryawan(Request $request)
    {
        $import = new PresensiImport;
        
        Excel::import($import, $request->file('file')->store('temp'));
        
        return back()->with('success', 'Excel file successfully imported');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
