<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="<?= base_url('asset/bootstrap-5.3.3-dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-6.6.0-web/css/fontawesome.css')?>">
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-6.6.0-web/css/brands.css')?>">
    <link rel="stylesheet" href="<?= base_url('asset/fontawesome-free-6.6.0-web/css/solid.css')?>">
</head>

<body>
<div class="container mt-5">
    <div class="container-header" style="display: flex; justify-content: center;">
        <h3 class="container_title" style="color: blue;"><strong>Data Buku</strong></h3>
    </div>
    <div class="container-body">
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#ModalTambahProduk">
            <i class="fa-solid fa-plus"></i> Tambah Data
        </button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <table class="table table-bordered" id="produkTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalTambahProdukLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalTambahProdukLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formProduk">
                    <div class="row mb-3">
                        <label for="namaProduk" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namaProduk">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="hargaProduk" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="hargaProduk">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stokProduk" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="stokProduk">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="simpanProduk">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditProduk" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h1 class="modal-title fs-5" id="modalEditProduk">Edit Produk</h1>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formProduk">
                                <div class="row mb-3">
                                    <label for="namaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" class="form-control" id="idProdukEdit" name="idProdukEdit">
                                        <input type="text" class="form-control" id="namaProdukEdit" name="namaProduk">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="hargaProduk" class="col-sm-4 col-from-label">Harga</label>
                                    <div class="col-sm-8">
                                        <input type="number" step="0.01" class="form-control" id="hargaProdukEdit">
                                    </div>
                                </div>
                            <div class="row mb-3">
                                <label for="imageProdukEdit" class="col-sm-4 col-form-label">Gambar</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="imageProdukEdit" accept="image/*">
                                    <img id="imagePreview" src="" alt="Product Image" class="mt-2" style="max-width: 200px; display: none;">
                                </div>
                            </div>


                                <div class="row mb-3">
                                    <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="stokProdukEdit">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="editProdukSimpan">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<script src="<?= base_url('asset/jquery/dist/jquery.min.js')?>"></script>
<script src="<?= base_url('asset/bootstrap-5.3.3-dist/js/bootstrap.min.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    tampilProduk();

    $("#formProduk").on("submit", function() {
        var formData = {
            nama_produk: $('#namaProduk').val(),
            harga: $('#hargaProduk').val(),
            stok: $('#stokProduk').val()
        };

        $.ajax({
            url: '<?= base_url('produk/simpan') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(hasil) {
                if(hasil.status === 'success') {
                    Swal.fire({
                    title: "Good job!",
                    text: "You clicked the button!",
                    icon: "success"
                    });
                    $('#ModalTambahProduk').modal('hide');
                    $('#formProduk')[0].reset();
                    tampilProduk();
                } else {
                    alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });


function tampilProduk() {
    $.ajax({
        url: '<?= base_url('produk/tampil') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(hasil) {
            if (hasil.status === 'success') {
                var produkTable = $('#produkTable tbody');
                produkTable.empty(); 
                
                var produk = hasil.produk;
                var no = 1;

                // looping untuk memasukkan data ke dalam table
                produk.forEach(function(item) {
                    var row = '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + item.nama_produk + '</td>' +
                        '<td>' + item.harga + '</td>' +
                        '<td>' + item.stok + '</td>' +
                        '<td>' +
                            '<button class="btn btn-warning btn-sm editProduk" data-id="' + item.produk_id + '" data-bs-toggle="modal" data-bs-target="#modalEditProduk"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                            '<button class="btn btn-danger btn-sm hapusProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash"></i> Hapus</button> ' +
                        '</td>' +
                    '</tr>';
                    produkTable.append(row);
                    no++;
                });
            } else {
                alert('Gagal mengambil data');
            }
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan: ' + error);
        }
    });

    $('#produkTable').on('click', '.hapusProduk', function() {
            var produkId = $(this).data('id');
            //var konfirmasi = confirm("Apakah Anda yakin ingin menghapus produk ini?");

            //if (konfirmasi) {
                $.ajax({
                    url: '<?= base_url('produk/hapus'); ?>/' + produkId,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            Swal.fire({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success"
                            });
                           
                        } else {
                            alert('Gagal menghapus data.');
                        }
                        tampilProduk();
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
           // }
        });

        $('#produkTable').on('click', '.editProduk', function() {
                    var row = $(this).closest('tr');
                    document.getElementById('idProdukEdit').value = $(this).data('id');
                    document.getElementById('namaProdukEdit').value = row.find('td:eq(1)').text()
                    document.getElementById('hargaProdukEdit').value = row.find('td:eq(2)').text()
                    document.getElementById('stokProdukEdit').value = row.find('td:eq(3)').text()
                    
                    
        });

        $('#modalEditProduk').on('click', '#editProdukSimpan', function() {
                        var formData = {
                            'id_produk': document.getElementById('idProdukEdit').value,
                            'nama_produk': document.getElementById('namaProdukEdit').value,
                            'harga': document.getElementById('hargaProdukEdit').value,
                            'stok': document.getElementById('stokProdukEdit').value
                        }

                        if (confirm('Apakah anda yakin ingin edit produk ini')) {
                            $.ajax({
                                url: '<?= base_url('produk/updateProduk') ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: formData,
                                success: function(response) {
                                    console.log(response);
                                    if (response.status == 'success') {
                                        Swal.fire({
                                        title: "Good job!",
                                        text: "You clicked the button!",
                                        icon: "success"
                                        });
                                        alert(response.message);
                                        $("#modalEditProduk").modal('hide')
                                        tampilProduk();
                                    } else {
                                        alert('gagal edit item: ' + response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('terjadi kesalahan saat edit item. ');
                                }
                            });
                        }
                    })
    }});
</script>


</body>
</html>