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
        public function update(Request $request, Servis $servis)
    {
        $data = $request->validate([
            'status' => ['required', 'integer', 'between:0,4'],
            'tgl_selesai' => ['nullable', 'date', 'after_or_equal:' . $servis->tgl_diterima->toDateString()],
            'harga' => ['nullable', 'integer', 'min:0'],
        ], [
            'tgl_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal diterima.',
            'harga.integer' => 'Harga harus berupa angka tanpa titik atau koma.',
        ]);

        DB::transaction(function () use ($data, $servis, $request) {
            $statusBaru = (int) $data['status'];
            $statusLama = $servis->status;

            $tglSelesai = $data['tgl_selesai'] ?? null;
            if ($statusBaru >= 3 && ! $tglSelesai) {
                $tglSelesai = now()->toDateString();
            }

            $servis->update([
                'status' => $statusBaru,
                'tgl_selesai' => $tglSelesai,
                'harga' => $data['harga'] ?? null,
            ]);

            if ($statusBaru > $statusLama) {
                for ($i = $statusLama + 1; $i <= $statusBaru; $i++) {
                    RiwayatStatus::create([
                        'servis_id' => $servis->id,
                        'status' => $i,
                        'waktu' => now(),
                        'diubah_oleh' => $request->user()->id,
                    ]);
                }
            } elseif ($statusBaru < $statusLama) {
                $servis->riwayat()->where('status', '>', $statusBaru)->delete();
            }
        });

        return redirect()->route('servis.show', $servis)->with('tersimpan', true);
    }
}