<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Alamat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AlamatController extends Controller
{
    public function index()
    {
        //ambil session id user
        $id_user = \Auth::user()->id;
        //ambil data alamat
        $users = DB::table('users')
                    ->select('users.*')
                    ->where('users.id', $id_user)
                    ->get();
        $data = array(
            'users' => $users
        );
        return view('user.alamat.alamatada',$data);
    }

    public function edit($id)
    {
        //menampilkan form edit alamat
        $data = array(
            'users' => User::findOrFail($id)
        );
        return view('user.alamat.editAlamat',$data); 
    }

    public function update($id,Request $request)
    {
        //mengupdate alamat
        $users = User::findOrFail($id);
        // Lalu update data nya ke database
        if( $request->file('jaminan')){
            
            Storage::delete('public/'.$users->jaminan);
            $file = $request->file('jaminan')->store('jaminans','public');
            $users->jaminan = $file;
        }

        $users->name = $request->name;
        $users->nomor_hp = $request->nomor_hp;
        $users->alamat = $request->alamat;
        $users->save();
        return redirect()->route('user.alamat');

    }
}
