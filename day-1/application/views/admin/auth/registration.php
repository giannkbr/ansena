<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <a href="<?= base_url('auth/registration') ?>" class="mb-5 d-block auth-logo">
                        <img src="" width="100px" height="100px" alt="">
                    </a>
                </div>
            </div>
        </div> -->
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mt-2">
                            <h5 class="text-primary">Register Account</h5>
                            <p class="text-muted">Register to access this web</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form action="<?= base_url('auth/registration'); ?>" method="POST">

                                <div class="mb-3">
                                    <label class="form-label" for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" value="<?= set_value('name'); ?>">
                                    <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Enter password">
                                    <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Confirm Password</label>
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm password">
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Register Account</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <p class="text-muted mb-0">Already have an account ? <a href="<?= base_url('auth'); ?>" class="fw-medium text-primary"> Login</a></p>
                                    <p class="text-muted mb-0">Los Password ? <a href="<?= base_url('auth/forgotpassword'); ?>" class="fw-medium text-primary"> Forgot Password</a></p>
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
        <!-- end row -->
    </div>
    <!-- end container -->
</div>