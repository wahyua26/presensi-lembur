<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function postLogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/presensi-masuk')->with('success','Anda Berhasil Login!');
        }
        return redirect('/')->with('fail', 'Email atau Password anda Salah!');
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success', 'Anda Berhasil Logout!');
    }

    public function register(){
        return view('login.register');
    }

    public function simpanRegister(Request $request){
        //dd($request);
        $this->validate($request,[
            'name' => 'required',
            'npp' => 'required|numeric|unique:users,npp',
            'jabatan' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'foto' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        User::create([
            'npp' => $request->npp,
            'name' => $request->name,
            'level' => $request->level,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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
        else{
            $data = ['foto' => 'avatar5.png'];
            $user->update($data);
        }

        return redirect()->route('list-karyawan')->with('success', 'Karyawan berhasil ditambah!');
    }
}
