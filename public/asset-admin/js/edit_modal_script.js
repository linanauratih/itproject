// Menangani klik tombol edit
$(document).on("click", ".edit-btn", function () {
    // Mendapatkan ID barang dari atribut data
    var id_barang = $(this).data('id');

    // Mengirim permintaan Ajax untuk mendapatkan data barang berdasarkan ID
    $.ajax({
        url: baseUrl + 'Admin/Barang/getBarangById/' + id_barang,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // Mengisi nilai input dalam modal dengan data yang diterima
            $('#edit_id_barang').val(response.id_barang);
            $('#edit_nama').val(response.nama);
            $('#edit_jumlah_stok').val(response.jumlah_stok);
            $('#edit_satuan').val(response.id_satuan);
            $('#edit_kategori').val(response.id_kategori);
            $('#edit_merk').val(response.id_merk);
        },
        error: function () {
            // Menangani kesalahan jika permintaan Ajax gagal
            alert('Gagal memuat data barang.');
        }
    });
});
