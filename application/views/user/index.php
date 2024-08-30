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
                        Edit Pengguna <?= $user->name ?>
                            <div class="card-tools">
                                <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='<?= base_url('') ?>'">Kembali</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="name" id="name" autocomplete="off" value="<?= set_value('name', $user->name) ?>" required>
                                        <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control form-control-sm" name="email" id="email" autocomplete="off" value="<?= set_value('email', $user->email) ?>" required>
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="images" class="col-sm-2 col-form-label col-form-label-sm">Image <sup>(optional)</sup></label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control form-control-sm" name="images" id="images" autocomplete="off">
                                        <?= form_error('images', '<small class="text-danger">', '</small>'); ?>
                                        <div><img src="<?= base_url() ?>assets/uploads/<?= $user->image ?>" class="img-thumbnail" alt="..."></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="password" id="password" autocomplete="off" value="<?= set_value('password') ?>">
                                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
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