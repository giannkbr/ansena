<!-- Hero -->
<section class="overflow-hidden" id="hero">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('assets/user/') ?>img/landingpage/1.jpg" class="d-block w-100" alt="..." />
                <div class="card-img-overlay container justify-content-center">
                    <div class="row">
                        <div class="col text-center">
                            <p class="card-text font-bold display-3 text-white">NEW ARRIVAL 2022</p>
                            <a href="<?= base_url('Product') ?>" class="btn yellow-button px-5 py-2">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('assets/user/') ?>img/landingpage/2.jpg" class="d-block w-100" alt="..." />
                <div class="card-img-overlay container justify-content-center">
                    <div class="row">
                        <div class="col text-center">
                            <h5 class="card-title yellow-text fw-light">Promo 20%</h5>
                            <p class="card-text font-bold display-3 text-white">Tahun Baru Imlek</p>
                            <a href="<?= base_url('Product') ?>" class="btn yellow-button px-5 py-2">Pesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<!-- Akhir Hero -->

<!-- Tersedia -->
<section class="py-5" id="tersedia">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h5>Tersedia juga di</h5>
                <a href="#" target="_blank">
                    <img src="<?= base_url('assets/user/') ?>img/landingpage/shopee-logo-40477 1.svg" class="img-fluid mx-5" alt="" />
                </a>
                <a href="" target="_blank">
                    <img src="<?= base_url('assets/user/') ?>img/landingpage/tokopedia-38840 1.svg" class="img-fluid mx-5" alt="" />
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Tersedia -->

<!-- Why -->
<section class="py-5 bg-white" id="why">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mt-auto">
                <h1 class="display-4 fw-bold">Kenapa memilih kita?</h1>
            </div>
            <div class="col-lg">
                <div class="row">
                    <div class="col-lg">
                        <h5 class="fw-bold yellow-text">Gratis Ongkir</h5>
                        <p class="fw-light small">
                            Kami Menyediakan gratis ongkir khususnya daerah jabodetabek </p>
                    </div>
                    <div class="col-lg">
                        <h5 class="fw-bold yellow-text">Banyak Pilihan</h5>
                        <p class="fw-light small">
                            Produk yang kami sediakan mulai dari Spring Bed hingga Sofa dengan berbagai macam tipe dan
                            juga warna yang bervarian </p>
                    </div>
                    <div class="col-lg">
                        <h5 class="fw-bold yellow-text">Mudah Dipasang</h5>
                        <p class="fw-light small">
                            Kami memikirkan bahwa produk yang kami berikan kepada pembeli agar mudah dipasang </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Why -->

<!-- New Arival -->
<section class="py-5" id="arival">
    <div class="container py-5">
        <div class="row">
            <div class="col text-center">
                <h2>New Arrival</h2>
            </div>
        </div>
        <div class="row arival-grid">
            <?php foreach ($barang as $barang) { ?>
                <div class="col-lg-12 py-2">
                    <a href="<?= base_url('barang/' . $barang->id) ?>" style="text-decoration: none">
                        <div class="bg-white">
                            <img style="height : 250px" src="<?= base_url('assets/images/uploads/barang/' . $barang->foto_barang) ?>" class="card-img-top p-3" alt="barang" />
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark"><?= $barang->nama ?></h5>
                                <p class="card-text mb-3 text-secondary"><?= "Rp " . number_format($barang->harga, 2, ",", "."); ?></p>
                               
                                <div class="btn-foto mt-2">
                                    <a href="<?= base_url('barang/' . $barang->id) ?>" class="btn px-5 py-2 yellow-button btn-foto">Pesan</a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Akhir New Arival -->

<!-- Contact -->
<section class="overflow-hidden" id="kontak">
    <div class="container-fluid p-0">
        <div class="row kontak-isi">
            <div class="col-lg">
                <img src="<?= base_url('assets/user/') ?>img/landingpage/Image.jpg" class="img-fluid" alt="" />
            </div>
            <div class="col-lg my-auto p-5">
                <h1 class="display-4 fw-bold text-white pb-3">Ada pertanyaan terkait produk?</h1>
                <a href="tel:+6281388912929" class="btn btn-light px-5 py-2 yellow-text shadow">Contact Us</a>
            </div>
        </div>
    </div>
</section>
<!-- Akhir Contact -->
