<div class="account-pages my-5  pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6 col-xl-5">
                <div>
                    <div class="card">

                        <div class="card-body p-4">

                            <div class="text-center mt-2">
                                <h5 class="text-primary">Reset Password</h5>
                                <p class="text-muted">Reset Password.</p>

                                <?= $this->session->flashdata('message'); ?>
                            </div>
                            <div class="p-2 mt-4">
                                <!-- <div class="alert alert-success text-center mb-4" role="alert">
                                    Enter your Email and instructions will be sent to you!
                                </div> -->
                                <form action="<?= base_url('auth/insomnia'); ?>" method="POST">

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Reset Password</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Remember It ? <a href="<?= base_url('auth'); ?>" class="fw-medium text-primary"> Login </a></p>
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