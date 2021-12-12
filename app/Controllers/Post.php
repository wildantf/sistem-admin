<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Post extends BaseController
{
    protected $postModel;

    public function __construct()
    {
        // inisiasi model post
        $this->postModel = new PostModel();
        // text helper
        $this->helpers = ['text'];
    }

    public function index()
    {
        $keyword = ($this->request->getVar('keyword'));

        if ($keyword) {
            $post = $this->postModel->search($keyword);
        } else {
            $post = $this->postModel;
        }

        return view('post/index', [
            'posts' => $post->paginate(5, 'posts'),
            'pager' => $this->postModel->pager,
        ]);
    }

    public function new()
    {
        // session untuk validation
        return view('post/new', [
            'validation' => \Config\Services::validation()
        ]);
    }

    public function show($slug)
    {
        $post = $this->postModel->getRecord($slug);
        // jika data post tidak ditemukan
        if (empty($post)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Post ' . $slug . ' tidak ditemukan');
        }

        return view('post/show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        // validasi
        if (!$this->validate([
            'title' => 'required|max_length[30]|is_unique[posts.title]',
            'body'  => [
                'rules' => 'required|min_length[15]',
                'errors' => [
                    'required' => '{field} post harus diisi.',
                    'min_length' => 'panjang {field} harus lebih atau sama dengan 15 karakter.'
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => '{field} harus diisi dengan gambar.'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->back()->withInput()->with('validation', $validation);
            return redirect()->back()->withInput();
        }

        // ambil gambar
        $fileImage = $this->request->getFile('image');
        
        if ($fileImage->getError() == 4) {
            $imageName = null; //jika tidak ada inputan gambar
        } else {
            // random nama file
            $imageName = $fileImage->getRandomName();

            // pindahkan file ke folder img
            $fileImage->move('img', $imageName);

            // ambil nama file image tanpa merubah nama
            // $imageName= $fileImage->getName();
            // dd($imageName);
        }


        $slug = url_title($this->request->getVar('title'), '-', true);
        // dd($this->request->getVar());
        $this->postModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'body' => $this->request->getVar('body'),
            'image' => $imageName
        ]);

        return redirect('posts')->with('success', 'Postingan berhasil ditambahkan');
    }

    public function delete($slug)
    {
        $post = $this->postModel->where(['slug' => $slug])->first();

        // jika image ada dan bukan default.jpg maka dihapus
        if (!empty($post['image'])) {
            unlink('img/' . $post['image']);
        }

        $this->postModel->where(['slug' => $slug])->delete();
        return redirect('posts')->with('warning', 'Post ' . $slug . ' telah dihapus'); //TODO: ubah menjadi title
    }

    public function edit($slug)
    {
        $post = $this->postModel->where(['slug' => $slug])->first();
        return view('post/edit', [
            'post' => $post,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($id)
    {
        // validasi
        if (!$this->validate([
            'title' => 'required|max_length[30]|is_unique[posts.title]',
            'body'  => 'required|min_length[15]',
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => '{field} harus diisi dengan gambar.'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->back()->withInput()->with('validation', $validation);
            return redirect()->back()->withInput();
        }

        $oldImageName = $this->request->getVar('oldImageName');

        // ambil gambar
        $fileImage = $this->request->getFile('image');
        if ($fileImage->getError() == 4) {
            $imageName = $oldImageName; //jika form input image tidak diisi
        } else {

            // jika oldimage tidak null maka oldimage dihapus
            if ($oldImageName) {
                // dd('img/'. $oldImageName);
                unlink('img/' . $oldImageName);
            }

            // random nama file
            $imageName = $fileImage->getRandomName();

            // pindahkan file ke folder img
            $fileImage->move('img', $imageName);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        // dd($this->request->getVar());
        $this->postModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'body' => $this->request->getVar('body'),
            'image' => $imageName
        ]);

        return redirect('posts')->with('success', 'Postingan berhasil diedit');
    }
}
