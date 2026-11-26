<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunController extends Controller
{
    public function index()
    {
        $akun = User::orderByRaw("case when peran = 'admin' then 0 else 1 end")
            ->orderBy('name')
            ->get();

        return view('petugas.akun.index', compact('akun'));
    }

    public function create()
    {
        return view('petugas.akun.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'required' => ':attribute wajib diisi.',
            'email' => 'Format email tidak valid.',
            'unique' => ':attribute sudah dipakai.',
            'min' => ':attribute minimal :min karakter.',
            'max' => ':attribute maksimal :max karakter.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Kata sandi',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'peran' => 'petugas',
        ]);

        return redirect()->route('akun.index')->with('ok', 'Akun petugas ditambahkan.');
    }

    public function status(Request $request, User $user)
    {
        if ($user->peran !== 'petugas') {
            abort(403, 'Hanya akun petugas yang bisa dinonaktifkan.');
        }

        $user->aktif = $user->aktif ? 0 : 1;
        $user->save();

        if (! $user->aktif) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
        }

        return back()->with('ok', $user->aktif ? 'Akun diaktifkan.' : 'Akun dinonaktifkan.');
    }
}