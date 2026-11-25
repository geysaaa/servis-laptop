<?php

namespace App\Http\Controllers;

use App\Models\RiwayatStatus;
use App\Models\Servis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServisController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = $request->query('status');

        $daftar = Servis::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('kode_tiket', 'ilike', "%{$q}%")
                      ->orWhere('nama_pelanggan', 'ilike', "%{$q}%")
                      ->orWhere('no_wa', 'like', "%{$q}%");
                });
            })
            ->when($status !== null && $status !== '', fn ($query) => $query->where('status', (int) $status))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('petugas.servis.index', compact('daftar', 'q', 'status'));
    }

    public function create()
    {
        return view('petugas.servis.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:100'],
            'no_wa' => ['required', 'regex:/^[0-9+\s-]{8,20}$/'],
            'merk_tipe' => ['required', 'string', 'max:100'],
            'keluhan' => ['required', 'string'],
            'kelengkapan' => ['nullable', 'string', 'max:150'],
            'tgl_diterima' => ['required', 'date'],
        ], [
            'no_wa.regex' => 'Nomor WhatsApp tidak valid.',
        ]);

        $data['no_wa'] = preg_replace('/\D/', '', $data['no_wa']);

        $servis = DB::transaction(function () use ($data, $request) {
            $servis = Servis::create($data + [
                'status' => 0,
                'dibuat_oleh' => $request->user()->id,
            ]);

            $servis->update([
                'kode_tiket' => 'SRV-' . str_pad($servis->id, 4, '0', STR_PAD_LEFT),
            ]);

            RiwayatStatus::create([
                'servis_id' => $servis->id,
                'status' => 0,
                'waktu' => now(),
                'diubah_oleh' => $request->user()->id,
            ]);

            return $servis;
        });

        return redirect()->route('servis.show', $servis)->with('baru', true);
    }

    public function show(Servis $servis)
    {
        $servis->load('riwayat');

        return view('petugas.servis.show', compact('servis'));
    }
}