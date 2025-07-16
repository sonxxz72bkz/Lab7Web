# Lab7Web - Praktikum Pemrograman Web 2

## Praktikum 1: PHP Framework (CodeIgniter 4)

### Tujuan
- Memahami konsep dasar framework dan MVC.
- Membuat program sederhana dengan CodeIgniter 4.

### Langkah-langkah

1. **Persiapan:**
   - Instalasi XAMPP, aktifkan ekstensi PHP (json, xml, intl, mysqlnd).
      Install XAMPP di: https://www.apachefriends.org/download.html
      ![Screenshot (115)](https://github.com/user-attachments/assets/bab72f62-6a85-438f-a32f-d484298a25a3)

   - Aktifkan ekstensi PHP (json, xml, intl, mysqlnd).
      ![Screenshot (116)](https://github.com/user-attachments/assets/320b09ef-b689-4107-9fca-6c6a970d3c71)
      ![Screenshot (110)](https://github.com/user-attachments/assets/55afb829-d31a-46c1-a38e-20c75e620d03)

   - Instalasi CodeIgniter4
      Install CI4 di: https://codeigniter.com/download
      ![Screenshot (117)](https://github.com/user-attachments/assets/59efc9ee-1cd9-4ab6-931e-86f70e901d59)

   - Buat folder `lab11_ci` di htdocs, ekstrak Zip CodeIgniter ke lab11_ci ganti namanya jadi ci4.
      ![Screenshot (118)](https://github.com/user-attachments/assets/e337838f-6bb4-4fa2-ae43-5405b82df5fc)
      ![Screenshot (119)](https://github.com/user-attachments/assets/28fb743d-f432-4dc2-b96c-741577a297f9)

2. **Persiapan:**
   - Buka folder ci4 menggunakan vs code
      ![Screenshot (120)](https://github.com/user-attachments/assets/f799c345-3c47-477c-866e-f0be60c59ffd)
   - Cari env ubah namanya menjadi .env, lalu hapus tanda # pada bagian CI_ENVIRONMENT = development. Jika belum ganti ke development ganti sendiri, itu untuk menghidupkan mode debugging
      ![Screenshot (121)](https://github.com/user-attachments/assets/40547dc8-6256-40c4-b310-a104fbf89453)
      mode debungging
      ![Screenshot (113)](https://github.com/user-attachments/assets/4c7991d2-daad-4ea7-8ab7-a8dbc415d260)

3. **Routing dan Controller:**
   - Tambah route: `/about`, `/contact`, `/faqs`, `/page/tos`
      ![Screenshot (122)](https://github.com/user-attachments/assets/d0714dd4-d508-4a71-87c9-c18b8681f15a)
   - Buat controller `Page.php` dengan method untuk setiap halaman.
      ![Screenshot (123)](https://github.com/user-attachments/assets/3a40c5bb-1c91-4eb1-8432-e290335b3b46)

4. **View dan Layout:**
   - Buat `template/header.php` dan `template/footer.php`
      ![Screenshot (124)](https://github.com/user-attachments/assets/fb959451-e037-4ea5-bb43-3493421e8daf)
      ![Screenshot (125)](https://github.com/user-attachments/assets/fa2d3a50-2fe9-4da4-8d59-8d4dc703fa15)

   - Buat view `about.php`, `contact.php`, dll. Include header & footer di setiap halaman.
      ![Screenshot (126)](https://github.com/user-attachments/assets/4f1b08ba-ddcc-4cbc-8396-c44c06347601)

5. **CSS Layout:**
   - Tambahkan `style.css` ke folder `public`.
      ![Screenshot (127)](https://github.com/user-attachments/assets/5a62015c-43eb-471e-a663-098014326164)

   - Gunakan layout praktikum 4 atau buat sendiri juga boleh.

### Hasil
> **![Screenshot (114)](https://github.com/user-attachments/assets/04d13db6-80d9-4f8f-a5ab-83db4f6a9283)**

---

## Praktikum 2: Framework Lanjutan (CRUD Artikel)

### Tujuan
- Memahami konsep Model
- Menerapkan operasi CRUD (Create, Read, Update, Delete)

### 1. Membuat Database `lab_ci4` dan table 'artikel'
```sql
CREATE DATABASE lab_ci4;

CREATE TABLE artikel (
  id INT(11) AUTO_INCREMENT,
  judul VARCHAR(200) NOT NULL,
  isi TEXT,
  gambar VARCHAR(200),
  status TINYINT(1) DEFAULT 0,
  slug VARCHAR(200),
  PRIMARY KEY(id)
);
```
![Screenshot (132)](https://github.com/user-attachments/assets/de943d95-be89-472a-a234-01eb7b7fec74)
---

### 2. Konfigurasi `.env`
```env
# Sesuaikan dengan MySQL mu
database.default.hostname = localhost
database.default.database = lab_ci4
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```
![Screenshot (133)](https://github.com/user-attachments/assets/e64e5efa-3489-4dc0-866b-479421815265)
---

### 3. Membuat Model `ArtikelModel.php`
`app/Models/ArtikelModel.php`
![Screenshot (134)](https://github.com/user-attachments/assets/c7b4997f-8c1e-4451-b6af-edc2674c618a)
---

### 4. Membuat Controller `Artikel.php`
`app/Controllers/Artikel.php`
```php
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
}
```

### 5. File View (`app/Views/artikel/`)
```php
<?= $this->include('template/header'); ?>

<?php if($artikel): foreach($artikel as $row): ?>
<article class="entry">
    <h2><a href="<?= base_url('/artikel/' . $row['slug']); ?>"><?= $row['judul']; ?></a></h2>
    <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" alt="<?= $row['judul']; ?>">
    <p><?= substr($row['isi'], 0, 200); ?></p>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>

<?= $this->include('template/footer'); ?>
```

### 6. Routing Tambahan `app/Config/Routes.php`
```php
$routes->get('/artikel', 'Artikel::index');
```
![Screenshot (128)](https://github.com/user-attachments/assets/0ef95bb2-6721-4f24-ab55-45320126d8f2)
---

### 7. Data Dummy SQL
```sql
INSERT INTO artikel (judul, isi, slug) VALUES
('Artikel pertama', 'Lorem Ipsum adalah contoh teks...', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang...', 'artikel-kedua');
```
![Screenshot (129)](https://github.com/user-attachments/assets/6b5da034-4ea0-4cd2-a8f7-8b501af77c57)
---

### 8. Tambahkan Controller `Artikel.php`
- Tambahkan function view
`app/Controllers/Artikel.php`
```php
public function view($slug) {
        $model = new ArtikelModel();
        $artikel = $model->where(['slug' => $slug])->first();
        if (!$artikel) throw PageNotFoundException::forPageNotFound();
        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }
``` 

### 9. File Detail (`app/Views/detail/`)
.
```php
<?= $this->include('template/header'); ?>

<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>
    <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" alt="<?= $artikel['judul']; ?>">
    <p><?= $artikel['isi']; ?></p>
</article>

<?= $this->include('template/footer'); ?>
```

### 10. Routing Tambahan `app/Config/Routes.php`
```php
$routes->get('/artikel/(:any)', 'Artikel::view/$1');
```
![Screenshot (130)](https://github.com/user-attachments/assets/05488b4a-7a9d-4cc3-b42a-c214aa2882b6)
---

### 11. Tambahkan Controller `Artikel.php`
- Tambahkan function admin
```php
public function admin_index() {
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        $title = 'Daftar Artikel';
        return view('artikel/admin_index', compact('artikel', 'title'));
    }
```

### 12. File admin (`app/Views/admin/artikel`)
#### `admin_index.php`
```php
<?= $this->include('template/admin_header'); ?>

<table class="table">
    <thead>
        <tr><th>ID</th><th>Judul</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
    <?php if($artikel): foreach($artikel as $row): ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td>
            <b><?= $row['judul']; ?></b>
            <p><small><?= substr($row['isi'], 0, 50); ?></small></p>
        </td>
        <td><?= $row['status']; ?></td>
        <td>
            <a class="btn" href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
            <a class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td colspan="4">Belum ada data.</td></tr>
    <?php endif; ?>
    </tbody>
</table>

<?= $this->include('template/admin_footer'); ?>
```

### 13. Routing Tambahan `app/Config/Routes.php`
```php
$routes->group('admin', function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});
```
![Screenshot (135)](https://github.com/user-attachments/assets/36431954-01f9-4f28-a867-58ac0ae8d8d9)
---

### 14. Tambahkan Controller `Artikel.php`
- Tambahkan function add
```php
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
```

### 15. File add (`app/Views/admin/artikel/add`)
#### `form_add.php` 
```php
<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>
<form action="" method="post">
    <p><input type="text" name="judul" placeholder="Judul Artikel"></p>
    <p><textarea name="isi" cols="50" rows="10" placeholder="Isi artikel..."></textarea></p>
    <p><input type="submit" value="Kirim" class="btn btn-large"></p>
</form>

<?= $this->include('template/admin_footer'); ?>
```
![Screenshot (136)](https://github.com/user-attachments/assets/c22c1cc9-314f-4244-8c29-08b7e3cfebbe)
---

### 16. Tambahkan Controller `Artikel.php`
- Tambahkan function edit
```php
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
```

### 17. File edit (`app/Views/admin/artikel/edit`)
#### `edit.php`
```php
<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>
<form action="" method="post">
    <p><input type="text" name="judul" value="<?= $data['judul']; ?>"></p>
    <p><textarea name="isi" cols="50" rows="10"><?= $data['isi']; ?></textarea></p>
    <p><input type="submit" value="Kirim" class="btn btn-large"></p>
</form>

<?= $this->include('template/admin_footer'); ?>
```
![Screenshot (137)](https://github.com/user-attachments/assets/4c595458-526b-46e7-9f36-19c35ca150b9)
---

### 18. Tambahkan Controller `Artikel.php`
- Tambahkan function delete
```php
public function delete($id) {
        $artikel = new ArtikelModel();
        $artikel->delete($id);
        return redirect('admin/artikel');
    }
```

### 📌 Kesimpulan
CRUD berhasil dibuat menggunakan CodeIgniter 4. Konsep MVC, validasi form, routing grup admin dan view template telah diterapkan.

---

## Praktikum 3: View Layout & View Cell

### Tujuan
- Pembuatan layout dengan `extend()` dan `section()`
- Komponen modular pakai View Cell
- Dinamis menampilkan artikel terkini
- Filter artikel berdasarkan kategori

### 1. Tambahkan Kolom created_at di Database
```sql
ALTER TABLE artikel ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP;
```

### 2. Membuat Layout Utama
- Buat folder 'layout' di 'app/views' lalu buat file 'main.php'
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My Website' ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>
        <nav>
            <a href="<?= base_url('/');?>" class="active">Home</a>
            <a href="<?= base_url('/artikel');?>">Artikel</a>
            <a href="<?= base_url('/about');?>">About</a>
            <a href="<?= base_url('/contact');?>">Kontak</a>
        </nav>
        <section id="wrapper">
            <section id="main">
                <?= $this->renderSection('content') ?>
            </section>
            <aside id="sidebar">
                <?= view_cell('App\\Cells\\ArtikelTerkini::render') ?>

                <div class="widget-box">
                    <h3 class="title">Widget Header</h3>
                    <ul>
                        <li><a href="#">Widget Link</a></li>
                        <li><a href="#">Widget Link</a></li>
                    </ul>
                </div>
                <div class="widget-box">
                    <h3 class="title">Widget Text</h3>
                    <p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada tincidunt arcu.</p>
                </div>
            </aside>
        </section>
        <footer>
            <p>&copy; 2021 - Universitas Pelita Bangsa</p>
        </footer>
    </div>
</body>
</html>
```

### 3. Modifikasi File View
- Ubah app/Views/home.php agar sesuai dengan layout baru:
```php
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>

<?= $this->endSection() ?>
```
- ubah juga file view yang lain mengikuti contoh home.php

### 4. Membuat Class View Cell
- Buat folder 'Cells' di dalam 'app/'. Buat file 'ArtikelTerkini.php' di dalam 'app/Cells/' dengan kode berikut:
```php
<?php

namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render($kategori = null)
{
    $model = new \App\Models\ArtikelModel();
    $query = $model->orderBy('created_at', 'DESC')->limit(5);

    if (!empty($kategori)) {
        $query->where('kategori', $kategori);
    }

    $artikel = $query->findAll();
    return view('components/artikel_terkini', ['artikel' => $artikel]);
}

}

```

### 5. Membuat View untuk View Cell
- Buat folder 'components' di dalam 'app/Views/'. Buat file 'artikel_terkini.php' di dalam 'app/Views/components/' dengan kode berikut:
```php
<h3>Artikel Terkini</h3>
<ul>
    <?php foreach ($artikel as $row): ?>
        <li><a href="<?= base_url('/artikel/' . $row['slug']) ?>"><?= $row['judul'] ?></a></li>
    <?php endforeach; ?>
</ul>
```
### Hasil view biasa & view cell
-view biasa
![Screenshot (129)](https://github.com/user-attachments/assets/b6574ad7-7075-4d0b-a2ee-bc44e777b88c)
---
-view cell
![Screenshot (140)](https://github.com/user-attachments/assets/c44986b8-f930-4738-9b3b-a4d6ee767238)
---

### 1: Apa manfaat View Layout?
### Jawab :
View Layout membuat kode HTML lebih terstruktur dan tidak diulang-ulang. Kita cukup buat 1 file layout, lalu view lain hanya isi kontennya saja. Sangat bermanfaat untuk efisiensi dan pemeliharaan.

### Soal 2: Apa beda View Cell vs View biasa?
### Jawab :
- View biasa: hanya menampilkan konten statis/dinamis langsung dari controller.
- View Cell: komponen modular, bisa digunakan berulang di banyak halaman tanpa mengganggu controller utama. Cocok untuk sidebar, header, notifikasi, dll.

### Soal 3: Modifikasi View Cell untuk tampilkan artikel dari kategori tertentu.
### Jawab :
- tambahkan kolom 'kategori' di tabel 'artikel'
```sql
ALTER TABLE artikel ADD COLUMN kategori VARCHAR(100) DEFAULT 'Teknologi';
```
- Tambahkan parameter 'kategori':
```php
public function render($kategori = null)
{
    $model = new ArtikelModel();
    $query = $model->orderBy('created_at', 'DESC')->limit(5);

    if ($kategori !== null) {
        $query->where('kategori', $kategori);
    }

    $artikel = $query->findAll();
    return view('components/artikel_terkini', ['artikel' => $artikel]);
}
```
- 📄 Panggil di layout:
```php
<?= view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => 'Teknologi']) ?>
```

---

## Praktikum 4: Modul Login & Auth

## Tujuan :
- Sistem login berbasis session
- Password hashing (password_hash, password_verify)
- Auth Filter untuk proteksi halaman admin
- Seeder untuk user dummy

### 1. Buat tabel
- Buat tabel User
```sql
CREATE TABLE user (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(200) NOT NULL,
  useremail VARCHAR(200),
  userpassword VARCHAR(200)
);
```

### 2. Buat Model
- Buat UserModel.php 'app/Models'
```php
<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'useremail', 'userpassword'];
}
```

### 3. Buat Controller
- Buat User.php 'app/Controllers'
```php
<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        helper(['form']);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Jika belum submit, tampilkan form login
        if (!$email) {
            return view('user/login');
        }

        $session = session();
        $model = new UserModel();
        $login = $model->where('useremail', $email)->first();

        if ($login) {
            $pass = $login['userpassword'];
            if (password_verify($password, $pass)) {
                $session->set([
                    'user_id' => $login['id'],
                    'user_name' => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in' => TRUE,
                ]);
                return redirect()->to('/admin/artikel');
            } else {
                $session->setFlashdata("flash_msg", "Password salah.");
                return redirect()->to('/user/login');
            }
        } else {
            $session->setFlashdata("flash_msg", "Email tidak terdaftar.");
            return redirect()->to('/user/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}
```

### 4. Buat view
- Buat folder user di 'app/views' lalu didalam folder user buat login.php
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>
    <div id="login-wrapper">
        <h1>Sign In</h1>

        <?php if(session()->getFlashdata('flash_msg')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('flash_msg') ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" required value="<?= set_value('email') ?>">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
```
![Screenshot (142)](https://github.com/user-attachments/assets/466836a1-1417-4af5-ad04-a69c7a249ec8)
---


### 5. Buat Seeder
- Buat 'UserSeeder.php'
```php
php spark make:seeder UserSeeder
```
- Buka 'app/Database/Seeds/UserSeeder.php'
```php
<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('App\Models\UserModel');
        $model->insert([
            'username' => 'admin',
            'useremail' => 'siadmin11@email.com',
            'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);
    }
}
```
```php
php spark db:seed UserSeeder
```

### 6. Buat filter
- Buat Auth.php di 'app/Filters'
```php
<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kosong
    }
}
```
- Tambahkan 'app/Config/Filters.php' di bagian $alies
```php
'auth' => App\Filters\Auth::class
```

### 7. Buat Log out
- Tambah fungsi log out di Controller 'app/Controllers/User.php'
```php
public function logout()
```
- Tambahkan tombol log out di 'app/views/artikel/admin_index.php'
```php
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h2>Daftar Artikel (Admin)</h2>
<a class="btn" href="<?= base_url('/admin/artikel/add'); ?>">Tambah Artikel</a>
<a class="btn btn-danger" href="<?= base_url('/user/logout'); ?>">Logout</a>

<table class="table">
    <thead>
        <tr><th>ID</th><th>Judul</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
        <?php if($artikel): foreach($artikel as $row): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><strong><?= $row['judul']; ?></strong><br><small><?= substr($row['isi'], 0, 50); ?>...</small></td>
            <td><?= $row['status']; ?></td>
            <td>
                <a class="btn" href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
                <a class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="4">Belum ada data.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?= $this->endSection() ?>
```
![Screenshot (143)](https://github.com/user-attachments/assets/ef392192-7914-4bdc-8c27-b2f8e5ca16bb)
---
https://github.com/user-attachments/assets/0183f3b3-6c71-43b5-a8db-9f13ded16ea5

---

## Praktikum 5: Pagination dan Pencarian

## Tujuan :
- Memahami konsep dasar Pagination di CodeIgniter 4
- Memahami konsep Pencarian Data
- Implementasi Pagination + Search dalam halaman admin artikel

### 1. Buat pagination dan seacrh
- Modifikasi 'admin_index()' di 'app/controller/Artikel.php'
```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $q = $this->request->getVar('q') ?? '';

    $model = new \App\Models\ArtikelModel();
    $data = [
        'title'   => $title,
        'q'       => $q,
        'artikel' => $model->like('judul', $q)->paginate(10),
        'pager'   => $model->pager,
    ];
    return view('artikel/admin_index', $data);
}
```
- Update 'app/Views/artikel/admin_index.php' dan tambahkan
```php
<form method="get" class="form-search">
    <input type="text" name="q" value="<?= esc($q) ?>" placeholder="Cari data">
    <input type="submit" value="Cari" class="btn btn-primary">
</form>
```
```php
<?= $pager->only(['q'])->links(); ?>
```
![Screenshot (145)](https://github.com/user-attachments/assets/9a3853d3-c8fb-43bf-a2d2-b0b52d8ad34f)

---

## Praktikum 6: Upload File Gambar

## Tujuan :
- Memahami konsep dasar file upload di CodeIgniter 4
- Menambahkan fitur unggah gambar saat membuat artikel

### 1. Modifikasi Artikel.php pada bagian method add()
```php
public function add()  
{
    $validation = \Config\Services::validation();
    $validation->setRules(['judul' => 'required']);

    $isDataValid = $validation->withRequest($this->request)->run();

    if ($isDataValid)
    {
        $file = $this->request->getFile('gambar');

        if ($file->isValid() && !$file->hasMoved()) {
            $file->move(ROOTPATH . 'public/gambar');
        }

        $artikel = new \App\Models\ArtikelModel();
        $artikel->insert([
            'judul'  => $this->request->getPost('judul'),
            'isi'    => $this->request->getPost('isi'),
            'slug'   => url_title($this->request->getPost('judul')),
            'gambar' => $file->getName(),
        ]);

        return redirect('admin/artikel');
    }

    $title = "Tambah Artikel";
    return view('artikel/form_add', compact('title'));
}
```
### 2. Ubah 'form_add.php' dan 'form_edit.php'
- Tambahkan di 'views/artikel/form_add.php'
```php
<p><input type="file" name="gambar" required></p>
```
![Screenshot (147)](https://github.com/user-attachments/assets/b84459ec-8a75-46c1-a55a-91b7a20db94e)
![Screenshot (148)](https://github.com/user-attachments/assets/076599cc-a36c-439d-8737-436613f19f39)
---
### 3. Ubah 'detail.php'
- Ubah 'detail.php' di 'app/Views/artikel/detail.php' agar bisa menampilkan gambar
```php
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>

    <?php if (!empty($artikel['gambar'])): ?>
        <img src="<?= base_url('/gambar/' . $artikel['gambar']) ?>" alt="<?= esc($artikel['judul']) ?>" style="max-width: 100%; height: auto; margin: 1em 0;">
    <?php endif; ?>

    <p><?= $artikel['isi']; ?></p>
</article>

<?= $this->endSection() ?>
```
### 4. Ubah 'index.php'
- Ubah 'index.php' di 'app/Views/artikel/index.php' agar bisa menampilkan gambar
```php
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?php if ($artikel): foreach ($artikel as $row): ?>
<article class="entry">
    <h2><a href="<?= base_url('/artikel/' . $row['slug']); ?>"><?= $row['judul']; ?></a></h2>
    <img src="<?= base_url('gambar/' . $row['gambar']) ?>" 
     alt="<?= esc($row['judul']) ?>" 
     style="width: 200px; height: auto; object-fit: cover; margin: 1em 0;">
    <p><?= substr($row['isi'], 0, 200); ?></p>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>

<?= $this->endSection() ?>
```
### 5. Update 'Artikel.php' dibagian method edit()
- buka 'app/controller/Artikel.php'
```php
public function edit($id)
    {
        $artikel = new \App\Models\ArtikelModel();

        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);

        if ($validation->withRequest($this->request)->run()) {
            $dataToUpdate = [
                'judul' => $this->request->getPost('judul'),
                'isi'   => $this->request->getPost('isi'),
            ];

            $file = $this->request->getFile('gambar');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $file->move(ROOTPATH . 'public/gambar');
                $dataToUpdate['gambar'] = $file->getName();
            }

            $artikel->update($id, $dataToUpdate);
            return redirect('admin/artikel');
        }

        $data = $artikel->find($id);
        $title = "Edit Artikel";
        return view('artikel/form_edit', compact('title', 'data'));
    }
```
### 6. Buat folder 'gambar' di public untu menyimpan gambar
![Screenshot (149)](https://github.com/user-attachments/assets/a1915dd3-f730-4edb-a06d-8fca498eeaf1)
---
![Screenshot (150)](https://github.com/user-attachments/assets/36cb8e62-118b-44dc-845e-a4d339144b73)
---
https://github.com/user-attachments/assets/260d7bb8-d87a-4aef-8c52-c796760fa38c

---

## Praktikum 7: Relasi Tabel dan Query Builder
## Tujuan :
- Menyambungkan tabel artikel dan kategori (relasi One-to-Many)
- Menggunakan Query Builder + JOIN
- Menampilkan artikel dengan nama kategori
- Menambah, mengedit, dan mencari artikel berdasarkan kategori

### 1. Tambahkan Tabel & Relasi
- Buat tabel 'kategori'
```sql
CREATE TABLE kategori (
    id_kategori INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    slug_kategori VARCHAR(100)
);
```
- Ubah tabel 'artikel' agar punya 'id_kategori'
```sql
ALTER TABLE artikel
ADD COLUMN id_kategori INT(11),
ADD CONSTRAINT fk_kategori_artikel
FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori);
```
### 2. Model
- Buat 'KategoriModel.php' di 'app/Models/KategoriModel.php'
```php
<?php

namespace App\Models;
use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_kategori', 'slug_kategori'];
}
```
- Update 'ArtikelModel.php' Tambahkan method untuk join ke kategori
```php
public function getArtikelDenganKategori()
{
    return $this->db->table('artikel')
        ->select('artikel.*, kategori.nama_kategori')
        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
        ->get()
        ->getResultArray();
}
```
### 3. Controller
- Buka 'Artikel.php' di 'app/Controller/Artikel.php' update pada bagian method , ,  dan 
'index()'
```php
public function index()
{
    $title = 'Daftar Artikel';
    $model = new ArtikelModel();
    $artikel = $model->getArtikelDenganKategori();
    return view('artikel/index', compact('artikel', 'title'));
}
```
'admin_index()'
```php
public function admin_index()
{
    $title = 'Daftar Artikel (Admin)';
    $model = new ArtikelModel();

    $q = $this->request->getVar('q') ?? '';
    $kategori_id = $this->request->getVar('kategori_id') ?? '';

    $builder = $model->table('artikel')
        ->select('artikel.*, kategori.nama_kategori')
        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

    if ($q !== '') $builder->like('artikel.judul', $q);
    if ($kategori_id !== '') $builder->where('artikel.id_kategori', $kategori_id);

    $data['artikel'] = $builder->paginate(10);
    $data['pager'] = $model->pager;
    $data['q'] = $q;
    $data['kategori_id'] = $kategori_id;

    $kategoriModel = new KategoriModel();
    $data['kategori'] = $kategoriModel->findAll();

    $data['title'] = $title;

    return view('artikel/admin_index', $data);
}
```
'add()'
```php
public function add()
{
    $validation = \Config\Services::validation();
    $validation->setRules([
        'judul' => 'required',
        'id_kategori' => 'required|integer'
    ]);

    if ($validation->withRequest($this->request)->run()) {
        $file = $this->request->getFile('gambar');
        $namaGambar = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $file->move(ROOTPATH . 'public/gambar');
            $namaGambar = $file->getName();
        }

        $artikel = new \App\Models\ArtikelModel();
        $artikel->insert([
            'judul'       => $this->request->getPost('judul'),
            'isi'         => $this->request->getPost('isi'),
            'slug'        => url_title($this->request->getPost('judul')),
            'gambar'      => $namaGambar,
            'id_kategori' => $this->request->getPost('id_kategori')
        ]);

        return redirect()->to('/admin/artikel');
    }

    $kategoriModel = new \App\Models\KategoriModel();
    $data['kategori'] = $kategoriModel->findAll();
    $data['title'] = "Tambah Artikel";
    return view('artikel/form_add', $data);
}
```
'edit()'
```php
public function edit($id)
{
    $artikelModel = new \App\Models\ArtikelModel();
    $dataLama = $artikelModel->find($id);

    $validation = \Config\Services::validation();
    $validation->setRules([
        'judul' => 'required',
        'id_kategori' => 'required|integer'
    ]);

    if ($validation->withRequest($this->request)->run()) {
        $dataToUpdate = [
            'judul'       => $this->request->getPost('judul'),
            'isi'         => $this->request->getPost('isi'),
            'id_kategori' => $this->request->getPost('id_kategori')
        ];

        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $file->move(ROOTPATH . 'public/gambar');
            $dataToUpdate['gambar'] = $file->getName();
        }

        $artikelModel->update($id, $dataToUpdate);
        return redirect()->to('/admin/artikel');
    }

    $kategoriModel = new \App\Models\KategoriModel();
    $data['kategori'] = $kategoriModel->findAll();
    $data['data'] = $dataLama;
    $data['title'] = "Edit Artikel";

    return view('artikel/form_edit', $data);
}
```
