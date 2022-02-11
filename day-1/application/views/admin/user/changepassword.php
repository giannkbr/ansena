<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0"><?= $title; ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="<?= base_url('user/changepassword'); ?>" method="POST">
                    <div class="mb-3 row">
                        <label for="current_password" class="col-md-2 col-form-label">Current Password</label>
                        <div class="col-md-5">
                            <input class="form-control" type="password" id="current_password" name="current_password" placeholder="Current Password" data-bs-toggle="popover" data-bs-trigger="focus" title="Current Password" data-bs-content="Silahkan masukkan password lama anda sebelumnya jika ingin merubah password">
                            <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password1" class="col-md-2 col-form-label">New Password</label>
                        <div class="col-md-5">
                            <input class="form-control" type="password" id="new_password1" name="new_password1" placeholder="New Password" data-bs-toggle="popover" data-bs-trigger="focus" title="New Password" data-bs-content="Silahkan masukkan password baru anda pastikan password terdiri dari karakter yang unik">
                            <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password2" class="col-md-2 col-form-label">Repeat Password</label>
                        <div class="col-md-5">
                            <input class="form-control" type="password" id="new_password2" name="new_password2" placeholder="Repeat Password" data-bs-toggle="popover" data-bs-trigger="focus" title="Repeat Password" data-bs-content="Silahkan ulangi password baru anda pastikan repeat password sama dengan new password">
                            <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="" class="col-md-2 col-form-label"></label>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-danger w-md">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->