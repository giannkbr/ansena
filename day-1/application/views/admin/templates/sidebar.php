<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

	<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
		<i class="fa fa-fw fa-bars"></i>
	</button>

	<div data-simplebar class="sidebar-menu-scroll">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title">Menu</li>

				<li>
					<a href="<?= base_url(); ?>">
						<i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url('user/userList'); ?>">
						<i class="uil-users-alt"></i>
						<span>Users List</span>
					</a>
				</li>

				<li>
					<a href="<?= base_url('admin/dataBarang'); ?>">
						<i class="uil-user-circle"></i>
						<span>Data Barang</span>
					</a>
				</li>

				<li class=" menu-title">User
				</li>

				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect">
						<i class="bx bxs-user"></i>
						<span>User</span>
					</a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?= base_url('user') ?>"><i class="bx bxs-user-circle"></i> My Profile</a></li>
						<li><a href="<?= base_url('user/edit') ?>"><i class="bx bx-user-check"></i> Edit Profile</a>
						</li>
						<li><a href="<?= base_url('user/changepassword') ?>"><i class="bx bx-key"></i> Change
								Password</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Sidebar -->
	</div>
</div>
<!-- Left Sidebar End -->

<div class="main-content">

	<div class="page-content">
		<div class="container-fluid">
