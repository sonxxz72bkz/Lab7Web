<?php

namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render($kategori = null)
{
    $model = new \App\Models\ArtikelModel();
    $query = $model->orderBy('created_at', 'DESC')->limit(5);

    // Jika kategori diset dan tidak kosong, filter
    if (!empty($kategori)) {
        $query->where('kategori', $kategori); // jika satu kategori
        // atau $query->whereIn('kategori', (array) $kategori); // jika array
    }

    $artikel = $query->findAll();
    return view('components/artikel_terkini', ['artikel' => $artikel]);
}

}
