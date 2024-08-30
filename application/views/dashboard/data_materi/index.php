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
                            <?php if ($this->session->userdata('role') === 'administrator') : ?>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='<?= base_url('materi/create') ?>'">Tambah Data</button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Judul Materi</th>
                                        <th>File Materi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($result as $res) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $res->nama_kategori ?></td>
                                            <td><?= $res->judul_materi ?></td>
                                            <td><?= $res->file_uploaded ?></td>
                                            <td>
                                                <?php if ($this->session->userdata('role') === 'administrator') : ?>
                                                    <button type="button" class="btn btn-warning btn-sm" onclick="window.location.href='<?= base_url('materi/edit/' . $res->id_materi) ?>'">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= base_url('materi/delete/' . $res->id_materi) ?>')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <a href="<?= base_url('assets/files/' . $res->file_uploaded) ?>" class="btn btn-secondary btn-sm" download>
                                                    <i class="fas fa-download"></i>
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