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
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="product-detail">
                            <div class="row">
                                <!-- Notifikasi -->
                                <?= $this->session->flashdata('message'); ?>

                                <div class="col-9">
                                    <div class="tab-content position-relative" id="v-pills-tabContent">

                                        <div class="product-wishlist">
                                            <a href="#">
                                                <i class="mdi mdi-heart-outline"></i>
                                            </a>
                                        </div>
                                        <div class="tab-pane fade show active">
                                            <div class="product-img">
                                                <img src="<?= base_url('assets/images/user-auth/') . $user['image']; ?>" alt="" class="img-fluid mx-auto d-block" data-zoom="<?= base_url('assets/images/user-auth/') . $user['image']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $user['name']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="mt-4 mt-xl-3 ps-xl-4">
                            <h5 class="font-size-14"><a href="#" class="text-muted">Name</a></h5>
                            <h4 class="font-size-20 mb-3"><?= $user['name']; ?></h4>

                            <!-- <div class="text-muted">
                                <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i> 4.2</span> 234 Reviews
                            </div> -->

                            <p class="mt-4 text-muted">Detail tentang : <span class="badge bg-pill bg-soft-danger font-size-12"><?= $user['name']; ?></span></p>

                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">

                                            <h5 class="font-size-14">Detail :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Name : <?= $user['name']; ?></li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Email : <?= $user['email']; ?></li>
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <h5 class="font-size-14">Member Since :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="uil uil-exchange text-primary me-1 font-size-16"></i> Member Since : <?= date('d F Y', $user['date_created']); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
        </div>
    </div>
</div>