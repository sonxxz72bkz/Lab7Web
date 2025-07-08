<?= $this->include('tamplate/admin_header'); ?>

<h2>Daftar Artikel</h2>
<a class="btn" href="<?= base_url('/admin/artikel/add'); ?>">Tambah Artikel</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($artikel): foreach ($artikel as $row): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td>
                <strong><?= $row['judul']; ?></strong><br>
                <small><?= substr($row['isi'], 0, 50); ?>...</small>
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

<?= $this->include('tamplate/admin_footer'); ?>
