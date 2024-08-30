<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></small></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            List <?= $title ?>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='<?= base_url('data-admin/create') ?>'">Tambah Data</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($result as $res) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $res->name ?></td>
                                            <td><?= $res->email ?></td>
                                            <td><img src="<?= base_url() ?>assets/uploads/<?= $res->image ?>" class="img-thumbnail" style="width: 50px;"></td>
                                            <td><?= $res->created_at ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='<?= base_url('data-admin/edit/' . $res->id) ?>'">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="javascript:void(0);" onclick="confirmDelete('<?= base_url('pesan/hapuspesan/' . $t['id_barang']); ?>', '<?= $t['nama_barang']; ?>')" class="btn btn-outline-danger fas fa-times"></a>
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this data!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>