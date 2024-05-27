<?= $this->extend('admin/layout/template') ?>

<?= $this->Section('content'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('Admin/BarangKeluar/tambah') ?>" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Barang</label>
                                <select class="form-select" id="nama" name="id_barang" required>
                                    <option value="">Pilih Barang</option>
                                    <?php foreach ($barang as $bar): ?>
                                        <option value="<?= $bar['id_barang'] ?>"><?= $bar['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_stok" class="form-label">Jumlah Stok</label>
                                <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" min="1"
                                    pattern="[1-9]\d*" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Masuk</label>
                                <input type="date"  id="tanggal" name="tanggal"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="id_satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <!-- Loop untuk menampilkan pilihan satuan dari database -->
                                    <?php foreach ($satuan as $sat): ?>
                                        <option value="<?= $sat['id_satuan'] ?>"><?= $sat['satuan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="id_kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <!-- Loop untuk menampilkan pilihan kategori dari database -->
                                    <?php foreach ($kategori as $kat): ?>
                                        <option value="<?= $kat['id_kategori'] ?>"><?= $kat['kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="merk" class="form-label">Merk</label>
                                <select class="form-select" id="merk" name="id_merk" required>
                                    <option value="">Pilih Merk</option>
                                    <!-- Loop untuk menampilkan pilihan merk dari database -->
                                    <?php foreach ($merk as $mrk): ?>
                                        <option value="<?= $mrk['id_merk'] ?>"><?= $mrk['merk'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4">
            <h2 class="mt-4">
                <?= $title ?>
            </h2>
            <a href="#" class="btn btn-primary" title="Tambah" data-bs-toggle="modal" data-bs-target="#tambahModal">
                Tambah Data
            </a>
            <button type="button" id="tombolCetak" class="btn btn-warning" onclick="cetakPDF()">
                Cetak PDF
            </button>
            <br>
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Barang Keluar
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Stok</th>
                                <th>Harga Jual</th>
                                <th>Tanggal Masuk</th>
                                <!-- <th>Satuan</th>
                                <th>Kategori</th>
                                <th>Merk</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barang_keluar as $key => $row): ?>
                                <tr>
                                    <td>
                                        <?= $key + 1 ?>
                                    </td>
                                    <td>
                                        <?= $row['nama'] ?>
                                    </td>
                                    <td>
                                        <?= $row['jumlah_stok'] ?>
                                    </td>
                                    <td>
                                        <?= $row['harga_jual'] ?>
                                    </td>
                                    <td>
                                        <?= $row['tanggal'] ?>
                                    </td>
                                    <!-- <td>
                                        <?= $row['nama_satuan'] ?>
                                    </td>
                                    <td>
                                        <?= $row['nama_kategori'] ?>
                                    </td>
                                    <td>
                                        <?= $row['nama_merk'] ?>
                                    </td> -->
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="#" class="btn btn-primary btn-sm" title="Edit" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <a href="<?= base_url('Admin/BarangKeluar/delete/' . $row['id_keluar']) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
</main>
<?= $this->endSection() ?>