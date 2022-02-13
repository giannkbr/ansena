<div class="account-pages my-5  pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6 col-xl-5">
                <div>
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mt-2">
                                <h5 class="text-primary">Change Password</h5>
                                <p class="text-muted"><?= $this->session->userdata('reset_email'); ?></p>

                                <?= $this->session->flashdata('message'); ?>
                            </div>
                            <div class="p-2 mt-4">

                                <form action="<?= base_url('auth/changepassword'); ?>" method="POST">

                                    <div class="mb-3">
                                        <label class="form-label" for="password1">New Password</label>
                                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter New Password...">
                                        <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password2">Repeat Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat Password...">
                                        <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Change Password</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script> Penjualan <i class="mdi mdi-heart text-danger"></i></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>