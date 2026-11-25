<?php

namespace App\Http\Controllers;

use App\Models\Servis;

class DashboardController extends Controller
{
    public function index()
    {
        $hitung = Servis::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $ringkasan = [
            'Diterima' => $hitung[0] ?? 0,
            'Diperiksa' => $hitung[1] ?? 0,
            'Dikerjakan' => $hitung[2] ?? 0,
            'Selesai, belum diambil' => $hitung[3] ?? 0,
        ];

        $terbaru = Servis::latest('id')->take(5)->get();

        return view('petugas.dashboard', compact('ringkasan', 'terbaru'));
    }
}