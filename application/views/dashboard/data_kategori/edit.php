<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title ?></h1>
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
                            Edit Nama Kategori
                            <div class="card-tools">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='<?= base_url('data-kategori') ?>'">Kembali</button>
                            </div>
                        </div>
                       
                        <div class="card-body">
                            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="nama_kategori" class="col-sm-2 col-form-label col-form-label-sm">Nama Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="nama_kategori" id="nama_kategori" autocomplete="off" value="<?= set_value('nama_kategori', $user->nama_kategori) ?>" required>
                                        <?= form_error('nama_kategori', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="float-right">
                                    <button type="submit" class="btn btn-info btn-sm">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-default btn-sm">
                                        Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($this->session->flashdata('failed') && !$this->session->flashdata('validation_errors')) : ?>
  <script>
    Swal.fire(
      'Error',
      '<?= $this->session->flashdata('message'); ?>',
      'error'
    );
  </script>
<?php endif; ?>