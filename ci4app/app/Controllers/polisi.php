<?php

namespace App\Controllers;

use App\Models\PolisiModel;

class polisi extends BaseController
{
    protected $polisiModel;
    public function __construct()
    {
        $this->polisiModel = new PolisiModel();
    }
    public function index()
    {
        // $polisi = $this->polisiModel->findAll();
        $data = [
            'title' => 'Daftar Polisi',
            'polisi' => $this->polisiModel->getpolisi()
        ];




        return view('polisi/index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail polisi',
            'polisi' => $this->polisiModel->getpolisi($slug)
        ];


        if (empty($data['polisi'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Anggota ' . $slug . ' tidak ditemukan.');
        }
        return view('polisi/detail', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Form Tambah Data Anggota',
            'validation' => \Config\Services::validation()
        ];

        return view('polisi/create', $data);
    }

    public function save()
    {
        if (!$this->validate([

            'nama_Anggota' => [
                'rules' => 'required|is_unique[polisi.nama_Anggota]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field}  sudah terdaftar'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [

                    'max_size' => 'Ukuran Gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {

            return redirect()->to('/polisi/create')->withInput();
        }


        $filefoto = $this->request->getFile('foto');
        if ($filefoto->getError() == 4) {
            $namafoto = 'tr.png';
        } else {
            $namafoto = $filefoto->getRandomName();
            $filefoto->move('img', $namafoto);
        }


        $slug = url_title($this->request->getVar('nama_Anggota'), '-', true);
        $this->polisiModel->save([
            'nama_Anggota' => $this->request->getVar('nama_Anggota'),
            'slug' => $slug,
            'pangkat' => $this->request->getVar('pangkat'),
            'jabatan' => $this->request->getVar('jabatan'),
            'foto' => $namafoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/polisi');
    }


    public function delete($id)
    {
        //cari gambar berdasarkan id
        $polisi = $this->polisiModel->find($id);
        //cek jika file gambar default
        if ($polisi['foto'] != 'tr.png') {
            //hapus gambar
            unlink('img/' . $polisi['foto']);
        }


        $this->polisiModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/polisi');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Anggota',
            'validation' => \Config\Services::validation(),
            'polisi' => $this->polisiModel->getpolisi($slug)
        ];

        return view('polisi/edit', $data);
    }

    public function update($id)
    {
        //cek judul
        $polisiLama = $this->polisiModel->getpolisi(($this->request->getVar('slug')));
        if ($polisiLama['nama_Anggota'] == $this->request->getVar('nama_Anggota')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[polisi.nama_Anggota]';
        }
        if (!$this->validate([

            'nama_Anggota' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field}  sudah terdaftar'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [

                    'max_size' => 'Ukuran Gambar terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {

            return redirect()->to('/polisi/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $filefoto = $this->request->getFile('foto');

        //cek gambar apakah gambar berubah?
        if ($filefoto->getError() == 4) {
            $namafoto = $this->request->getVar('fotoLama');
        } else {
            //generate file random
            $namafoto = $filefoto->getRandomName();
            //pindahkan gambar
            $filefoto->move('img', $namafoto);
            //hapus file lama
            unlink('img/' . $this->request->getVar('fotoLama'));
        }


        $slug = url_title($this->request->getVar('nama_Anggota'), '-', true);
        $this->polisiModel->save([
            'id' => $id,
            'nama_Anggota' => $this->request->getVar('nama_Anggota'),
            'slug' => $slug,
            'pangkat' => $this->request->getVar('pangkat'),
            'jabatan' => $this->request->getVar('jabatan'),
            'foto' => $namafoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/polisi');
    }
}
