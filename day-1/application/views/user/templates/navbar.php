 <?php if ($this->uri->segment(1) == 'homepages' || $this->uri->segment(1) == NULL) { ?>
 <!-- Navbar homepages -->
 <nav class="navbar navbar-expand-md navbar-light fixed-top my-auto" id="navbar">
 	<div class="container">
 		<a class="navbar-brand fw-bold bt" href="<?= base_url('homepages') ?>">Belanjain</a>
 		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
 			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
 			<span class="navbar-toggler-icon"></span>
 		</button>
 		<div class="collapse navbar-collapse" id="navbarSupportedContent">
 			<ul class="navbar-nav ms-5 me-auto">
 				<li class="nav-item">
 					<a class="nav-link active" href="<?= base_url('homepages') ?>">Home</a>
 				</li>
 			</ul>
 			<ul class="navbar-nav">
 				<li class="nav-item my-auto me-3">
 				</li>
 				<li class="nav-item cartres my-auto me-4">
 					<div id="cart" class="d-none"></div>
 					<a href="<?= base_url('Cart') ?>" class="cart h5 bt position-relative d-inline-flex"
 						aria-label="View your shopping cart">
 						<i class="bi bi-cart3"></i>
 						<div id="total_items"></div>
 					</a>
 				</li>
 				<?php if ($this->session->userdata('email')) { ?>
 				<li class="nav-item dropdown my-auto">
 					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
 						<li>
 							<p class="fw-light text-secondary small text-center">Hai, <?= $user['name'] ?></p>
 						</li>
 						<hr />
 						<li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
 						<li><a class="dropdown-item" href="<?= base_url('status') ?>">Status Pesanan</a></li>
 						<li><a class="dropdown-item" href="<?= base_url('alamat') ?>">Alamat</a></li>
 						<hr />
 						<li><a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin logout?')"
 								href="<?= base_url('auth/logout') ?>">Log Out</a></li>
 					</ul>
 				</li>
 				<?php } else { ?>
 				<li class="nav-item my-auto">
 					<a class="nav-link my-auto bt btn btn-warning px-5" href="<?= base_url('auth') ?>">Login</a>
 				</li>
 				<?php } ?>
 			</ul>
 		</div>
 	</div>
 </nav>
 <!-- Akhir Navbar -->

 <?php } else { ?>
 <!-- Navbar Selain homepages -->
 <nav class="navbar navbar-expand-lg navbar-light py-3" id="navbar">
 	<div class="container">
 		<a class="navbar-brand fw-bold" href="<?= base_url('homepages') ?>">A3MALL</a>
 		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
 			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
 			<span class="navbar-toggler-icon"></span>
 		</button>
 		<div class="collapse navbar-collapse" id="navbarSupportedContent">
 			<ul class="navbar-nav ms-5 me-auto">
 				<li class="nav-item">
 					<a class="nav-link <?php if ($this->uri->segment(1) == 'homepages' || $this->uri->segment(1) === FALSE) {
                                                echo 'active';
                                            } ?>" href="<?= base_url('homepages') ?>">Home</a>
 				</li>
 				<li class="nav-item">
 					<a class="nav-link  <?php if ($this->uri->segment(1) == 'product' || $this->uri->segment(1) === FALSE) {
                                                    echo 'active';
                                                } ?>" href="<?= base_url('product') ?>">Produk</a>
 				</li>
 			</ul>
 			<ul class="navbar-nav">
 				<!-- <li class="nav-item my-auto me-3">
                         <form class="input-group">
                             <span class="input-group-text border-0 bg-white" id="basic-addon1"><i class="bi bi-search"></i></span>
                             <input class="form-control border-0" type="search" placeholder="Search" aria-label="Search" />
                         </form>
                     </li> -->
 				<li class="nav-item cartres my-auto me-4">
 					<div id="cart" class="d-none"></div>
 					<a href="<?= base_url('Cart') ?>" class="cart text-dark h5 position-relative d-inline-flex"
 						aria-label="View your shopping cart">
 						<i class="bi bi-cart3"></i>
 						<div id="total_items">

 						</div>
 					</a>
 				</li>
 				<?php if ($this->session->userdata('email')) { ?>
 				<li class="nav-item dropdown my-auto">
 					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
 						<li>
 							<p class="fw-light text-secondary small text-center">Hai, <?= $user['name'] ?></p>
 						</li>
 						<hr />
 						<li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
 						<li><a class="dropdown-item" href="<?= base_url('status') ?>">Status Pesanan</a></li>
 						<li><a class="dropdown-item" href="<?= base_url('alamat') ?>">Alamat</a></li>
 						<hr />
 						<li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Log Out</a></li>
 					</ul>
 				</li>

 				<?php } else { ?>
 				<li class="nav-item my-auto">
 					<a class="nav-link my-auto bt btn btn-warning px-5 rounded-pill"
 						href="<?= base_url('auth') ?>">Login</a>
 				</li>
 				<?php } ?>
 			</ul>
 		</div>
 	</div>
 </nav>
 <!-- Akhir Navbar -->
 <?php } ?>
