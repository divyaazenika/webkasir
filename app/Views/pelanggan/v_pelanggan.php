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
        <h3 class="container_title" style="color: blue;"><strong>Data Pelanggan</strong></h3>
    </div>
    <div class="container-body">
        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#ModalTambahpelanggan">
            <i class="fa-solid fa-plus"></i> Tambah Pelanggan
        </button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container mt-5">
                <table class="table table-bordered" id="pelangganTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>alamat</th>
                            <th>telepon</th>
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
<div class="modal fade" id="ModalTambahpelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalTambahpelangganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalTambahpelangganLabel">Tambah Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formpelanggan">
                    <div class="row mb-3">
                        <label for="namapelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namapelanggan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="telepon" class="col-sm-2 col-form-label">telepon</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="telepon">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="simpanpelanggan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditpelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditpelanggan" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h1 class="modal-title fs-5" id="modalEditpelanggan">Edit pelanggan</h1>
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formpelanggan">
                                <div class="row mb-3">
                                    <label for="namapelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" class="form-control" id="idpelangganEdit" name="idpelangganEdit">
                                        <input type="text" class="form-control" id="namapelangganEdit" name="namapelanggan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alamatpelanggan" class="col-sm-4 col-from-label">alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" step="0.01" class="form-control" id="alamatpelangganEdit">
                                    </div>
                                </div>
                              
                                <div class="row mb-3">
                                    <label for="stokpelanggan" class="col-sm-4 col-form-label">telepon</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="teleponpelangganEdit">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="editpelangganSimpan">Simpan Perubahan</button>
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
    tampilpelanggan();

    $("#simpanpelanggan").on("click", function() {
        var formData = {
            nama_pelanggan: $('#namapelanggan').val(),
            alamat: $('#alamat').val(),
            telepon: $('#telepon').val()
        };

        $.ajax({
            url: '<?= base_url('pelanggan/simpan') ?>',
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
                    $('#ModalTambahpelanggan').modal('hide');
                    $('#formpelanggan')[0].reset();
                    tampilpelanggan();
                } else {
                    alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });

    function tampilpelanggan() {
    $.ajax({
        url: '<?= base_url('pelanggan/tampil') ?>',
        type: 'GET',
        dataType: 'json',
        success: function(hasil) {
            if (hasil.status === 'success') {
                var pelangganTable = $('#pelangganTable tbody');
                pelangganTable.empty(); 
                
                var pelanggan = hasil.pelanggan;
                var no = 1;

                // looping untuk memasukkan data ke dalam table
                pelanggan.forEach(function(item) {
                    var row = '<tr>' +
                        '<td>' + no + '</td>' +
                        '<td>' + item.nama_pelanggan + '</td>' +
                        '<td>' + item.alamat+ '</td>' +
                        '<td>' + item.telepon + '</td>' +
                        '<td>' +
                            '<button class="btn btn-warning btn-sm editpelanggan" data-id="' + item.id_pelanggan + '" data-bs-toggle="modal" data-bs-target="#modalEditpelanggan"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                            '<button class="btn btn-danger btn-sm hapuspelanggan" id="' + item.id_pelanggan + '"><i class="fa-solid fa-trash"></i> Hapus</button> ' +
                        '</td>' +
                    '</tr>';
                    pelangganTable.append(row);
                    console.log(item.pelanggan_id);
                    
                    no++;
                });
            } else {
                alert('Gagal mengambil data');
            }
        },
        error: function(xhr, status, error) {
            alert('Terjadi kesalahan: ' + error);
        }
    });}
    
    $('#pelangganTable').on('click', '.hapuspelanggan', function() {
            var pelangganid= $(this).attr('id');
            console.log(pelangganid);
            
            //var konfirmasi = confirm("Apakah Anda yakin ingin menghapus produk ini?");

            //if (konfirmasi) {
                $.ajax({
                    url: '<?= base_url('pelanggan/hapus'); ?>/' + pelangganid,
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
                        tampilpelanggan();
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
           // }
        });
        $('#pelangganTable').on('click', '.editpelanggan', function() {
                    var row = $(this).closest('tr');
                    document.getElementById('idpelangganEdit').value = $(this).data('id');
                    document.getElementById('namapelangganEdit').value = row.find('td:eq(1)').text()
                    document.getElementById('alamatpelangganEdit').value = row.find('td:eq(2)').text()
                    document.getElementById('teleponpelangganEdit').value = row.find('td:eq(3)').text()
                    
                    
        });

        $('#modalEditpelanggan').on('click', '#editpelangganSimpan', function() {
                        var formData = {
                            'id_pelanggan': document.getElementById('idpelangganEdit').value,
                            'nama_pelanggan': document.getElementById('namapelangganEdit').value,
                            'alamat_pelanggan': document.getElementById('alamatpelangganEdit').value,
                            'telepon_pelanggan': document.getElementById('teleponpelangganEdit').value
                        }

                        if (confirm('Apakah anda yakin ingin edit pelangganini')) {
                            $.ajax({
                                url: '<?= base_url('pelanggan/updatepelanggan') ?>',
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
                                        $("#modalEditpelanggan").modal('hide')
                                        tampilpelanggan();
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
                });
    
</script>
