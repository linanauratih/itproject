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
                        <form action="<?= base_url('Admin/BarangMasuk/tambah') ?>" method="post">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Barang</label>
                                <select class="form-select" id="nama" name="nama" required>
                                    <option value="">Pilih Barang</option>
                                    <?php foreach ($barang as $bar): ?>
                                        <option value="<?= $bar['nama'] ?>"><?= $bar['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_stok" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" min="1"
                                    pattern="[1-9]\d*" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" min="1"
                                    pattern="[1-9]\d*" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Masuk</label>
                                <input type="date" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <?php foreach ($satuan as $item): ?>
                                        <option value="<?= $item['id_satuan'] ?>"><?= $item['satuan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $item): ?>
                                        <option value="<?= $item['id_kategori'] ?>"><?= $item['kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="merk" class="form-label">Merk</label>
                                <select class="form-select" id="merk" name="merk" required>
                                    <option value="">Pilih Merk</option>
                                    <?php foreach ($merk as $item): ?>
                                        <option value="<?= $item['id_merk'] ?>"><?= $item['merk'] ?></option>
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
            <?php
            // Tampilkan pesan error jika ada
            if (session()->has('error')) {
                echo '<div class="alert alert-danger">' . session('error') . '</div>';
            }

            // Tampilkan pesan sukses jika ada
            if (session()->has('success')) {
                echo '<div class="alert alert-success">' . session('success') . '</div>';
            }
            ?>
            <button type="button" id="tombolCetak" class="btn btn-warning" onclick="cetakPDF()">
                Cetak PDF
            </button>
            <br>
            <br>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Barang Masuk
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Stok</th>
                                <th>Harga Beli</th>
                                <th>Tanggal Masuk</th>
                                <th>Satuan</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barang_masuk as $key => $row): ?>
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
                                        <?= $row['harga_beli'] ?>
                                    </td>
                                    <td>
                                        <?= $row['tanggal'] ?>
                                    </td>
                                    <td>
                                        <?= $row['nama_satuan'] ?>
                                    </td>
                                    <td>
                                        <?= $row['nama_kategori'] ?>
                                    </td>
                                    <td>
                                        <?= $row['nama_merk'] ?>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <a href="#" class="btn btn-primary btn-sm" title="Edit" data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <a href="<?= base_url('Admin/BarangMasuk/delete/' . $row['id_masuk']) ?>"
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
<script>
$(document).ready(function() {
    // Event handler untuk memanggil fungsi getBarangDetails saat nama barang dipilih
    $('#nama_barang_dropdown').change(function() {
        var namaBarang = $(this).val();
        getBarangDetails(namaBarang);
    });

    // Fungsi untuk mengambil detail barang dengan AJAX
    function getBarangDetails(namaBarang) {
        $.ajax({
            url: 'Admin/BarangMasuk/detail/', // Ganti dengan URL yang sesuai
            type: 'GET',
            data: { nama_barang: namaBarang },
            success: function(response) {
                // Perbarui nilai input dengan detail barang dari respons
                $('#merk_input').val(response.merk);
                $('#kategori_input').val(response.kategori);
                $('#satuan_input').val(response.satuan);

                // Kunci input kategori, merk, dan satuan
                $('#kategori_input').prop('disabled', true);
                $('#merk_input').prop('disabled', true);
                $('#satuan_input').prop('disabled', true);
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    }
});
</script>
<?= $this->endSection() ?>