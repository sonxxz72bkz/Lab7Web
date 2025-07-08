<?php

namespace App\Controllers;
use App\Models\ArtikelModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function index() {
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        $title = 'Daftar Artikel';
        return view('artikel/index', compact('artikel', 'title'));
    }

    public function view($slug) {
        $model = new ArtikelModel();
        $artikel = $model->where(['slug' => $slug])->first();
        if (!$artikel) throw PageNotFoundException::forPageNotFound();
        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }

    public function admin_index() {
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        $title = 'Daftar Artikel';
        return view('artikel/admin_index', compact('artikel', 'title'));
    }

    public function add() {
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        if ($validation->withRequest($this->request)->run()) {
            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi'   => $this->request->getPost('isi'),
                'slug'  => url_title($this->request->getPost('judul')),
            ]);
            return redirect('admin/artikel');
        }
        $title = "Tambah Artikel";
        return view('artikel/form_add', compact('title'));
    }

    public function edit($id) {
        $artikel = new ArtikelModel();
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        if ($validation->withRequest($this->request)->run()) {
            $artikel->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi'   => $this->request->getPost('isi'),
            ]);
            return redirect('admin/artikel');
        }
        $data = $artikel->where('id', $id)->first();
        $title = "Edit Artikel";
        return view('artikel/form_edit', compact('title', 'data'));
    }

    public function delete($id) {
        $artikel = new ArtikelModel();
        $artikel->delete($id);
        return redirect('admin/artikel');
    }
}