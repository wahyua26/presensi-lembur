<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use DateTime;
use DateTimeZone;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = User::sortable()->paginate();
        return view('karyawan.list-karyawan', ['karyawan' => $karyawan]);
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
        //
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
    public function edit($npp)
    {
        //dd($npp);
        //$user = User::where('npp',$npp)->get();
        $user = DB::table('users')->where('npp', $npp)->first();
        //dd($user->name);
        return view('karyawan.edit-karyawan', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'npp' => 'required|numeric|unique:users,npp',
            'jabatan' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        
        $user = User::where([
            ['npp','=',$request->npp],
        ])->first();

        if($request->hasFile('foto'))
        {
            $filename = uniqid() . '.png';
            $request->foto->storeAs('images',$filename,'public');
            $data = ['foto' => $filename];
            $user->update($data);
        }
        //dd($filename);
       $data = [
        'name' => $request->name,
        'npp' => $request->npp,
        'level' => $request->level,
        'jabatan' => $request->jabatan,
        'email' => $request->email,
        'password' => bcrypt($request->password),
       ];

       //dd($data);
       $user->update($data);
       //dd($user);
       return redirect()->route('list-karyawan')->with('success', 'Karyawan berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::where([
            ['npp','=',$request->npp],
        ])->delete();

        return redirect()->route('list-karyawan')->with('success', 'Karyawan berhasil dihapus!');
    }

    // public function lokasi(Request $request)
    // {
    //     /* $ip = $request->ip(); Dynamic IP address */
    //     //dd($request);
    //     $ip = '162.159.24.227'; /* Static IP address */
    //     $currentUserInfo = Location::get($ip);
          
    //     return view('user', compact('currentUserInfo'));
    // }

    public function viewProfile($npp)
    {
        $timezone = 'Asia/Jakarta';
        $date = new Datetime('now', new DateTimeZone($timezone));
        $tanggal = $date->format('Y-m-d');

        $user = User::where([
            ['npp','=',$npp],
        ])->first();
        //dd($user);
        $presensi = DB::table('presensi')->where('user_npp', $npp)->orderBy('tgl','desc')->limit(5)->get();
        //dd($presensi);
        return view('karyawan.profile', ['user' => $user, 'presensi' => $presensi, 'tanggal' => $tanggal]);
    }

    public function editProfile($npp)
    {
        //dd($npp);
        //$user = User::where('npp',$npp)->get();
        
        $user = DB::table('users')->where('npp', $npp)->first();
        //dd($user->name);
        return view('karyawan.edit-profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {   
        $this->validate($request,[
            'name' => 'required',
            'npp' => 'required|numeric|unique:users,npp',
            'jabatan' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $user = User::where([
            ['npp','=',$request->npp],
        ])->first();

        if($request->hasFile('foto'))
        {
            $filename = uniqid() . '.png';
            $request->foto->storeAs('images',$filename,'public');
            $data = ['foto' => $filename];
            $user->update($data);
        }
       
       $data = [
        'name' => $request->name,
        'npp' => $request->npp,
        'level' => $request->level,
        'jabatan' => $request->jabatan,
        'email' => $request->email,
        'password' => bcrypt($request->password),
       ];

       //dd($data);
       $user->update($data);
       //dd($user);
       return redirect()->route('view-profile', ['npp' => $request->npp ])->with('success', 'Karyawan berhasil diedit!');
    }

    public function editFotoProfile(Request $request)
    {
        //dd($request);
        $user = User::where([
            ['npp','=',$request->npp],
        ])->first();

        $filename = uniqid() . '.png';
        $request->foto->storeAs('images',$filename,'public');
        $data = ['foto' => $filename];
        $user->update($data);

        return redirect()->route('view-profile', ['npp' => $request->npp ])->with('success', 'Foto profil berhasil diedit!');
    }

    public function export ()
    {
        return Excel::download(new UserExport(), 'Daftar Karyawan.xlsx');
    }

    public function import(Request $request)
    {
        //dd($request);
        $import = new UsersImport;
        
        Excel::import($import, $request->file('file')->store('temp'));
        
        return back()->with('success', 'Excel file successfully imported');
    }
}
