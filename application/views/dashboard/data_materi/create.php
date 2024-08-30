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
                            Tambah <?= $title ?>
                            <div class="card-tools">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='<?= base_url('materi') ?>'">Kembali</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="id_kategori" class="col-sm-2 col-form-label col-form-label-sm">ID Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="id_kategori" id="id_kategori" class="form-control form-control-sm" required>
                                            <option value="">--- Pilih Kategori ---</option>
                                            <?php foreach ($kategori as $row) : ?>
                                                <option value="<?= $row->id_kategori ?>"><?= $row->nama_kategori ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="judul_materi" class="col-sm-2 col-form-label col-form-label-sm">Judul Materi</label>
                                    <div class="col-sm-10">
                                        <input type="judul_materi" class="form-control form-control-sm" name="judul_materi" id="judul_materi" autocomplete="off" value="<?= set_value('judul_materi') ?>" required>
                                        <?= form_error('judul_materi', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="file_uploaded" class="col-sm-2 col-form-label col-form-label-sm">File Materi</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control form-control-sm" name="file_uploaded" id="file_uploaded" autocomplete="off" accept=".pdf" required>
                                        <?= form_error('file_uploaded', '<small class="text-danger">', '</small>'); ?>
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