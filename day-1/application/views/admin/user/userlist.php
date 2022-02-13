 <!-- start page title -->
 <div class="row">
     <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
             <h4 class="mb-0"><?= $title; ?></h4>

             <div class="page-title-right">
                 <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Dashboard</a></li>
                     <li class="breadcrumb-item active"><?= $title ?></li>
                 </ol>
             </div>

         </div>
     </div>
 </div>
 <!-- end page title -->

 <div class="row">
     <div class="col-12">
         <div class="card">
             <div class="card-body">
                
                <div class="row mb-2">
					<div class="col-md-6">
						<div class="mb-3">
							<button type="button" class="btn btn-success btn-responsive" data-toggle="tooltip"
								data-placement="top" title="Tambah User" onclick="add_user()"><i
									class="uil-plus-circle"></i> Add user</button>
							<button class="btn btn-info btn-responsive" data-toggle="tooltip" data-placement="top"
								title="Reload" onclick="reload_table()"><i class="uil-sync"></i> Reload</button>
							<button id="deleteList" class="btn btn-danger btn-responsive" data-toggle="tooltip"
								data-placement="right" title="Delete List" style="display: none;"
								onclick="deleteList()"><i class="uil-trash-alt"></i> Delete List</button>

						</div>
					</div>
				</div>
                 <p class="card-title-desc">Daftar Seluruh: <span class="badge bg-pill bg-soft-success font-size-12">USERS</span>.
                 </p>

                 <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Image</th>
                             <th>Name</th>
                             <th>email</th>
                             <th>Role</th>
                             <th>Date Created</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php $i = 1; ?>
                         <?php foreach ($allUsers as $row) : ?>

                             <?php $rolename = ($row['role_id'] == 1) ? '<span class="badge bg-pill bg-soft-danger font-size-12">ADMINISTRATOR</span>' : '<span class="badge bg-pill bg-soft-success font-size-12">USER</span>'; ?>
                             <?php $auth_tooltip = ($row['role_id'] == 1) ? 'Administrator' : 'User'; ?>
                             <tr>
                                 <td><?= $i; ?></td>
                                 <td><a href="<?= base_url('assets/images/user-auth/') . $row['image']; ?>" target="_blank" data-bs-toggle="tooltip" data-bs-placement="right" title="<?= $auth_tooltip; ?>"><img width="50px" height="50px" src="<?= base_url('assets/images/user-auth/') . $row['image']; ?>" class="avatar-xs rounded-circle me-2" /></a></td>
                                 <td><?= $row['name']; ?></td>
                                 <td><?= $row['email'] ?></td>
                                 <td><?= $rolename; ?></td>
                                 <td><?= date('d F Y', $row['date_created']); ?></td>
                             </tr>
                             <?php $i++; ?>
                         <?php endforeach; ?>

                     </tbody>
                 </table>

             </div>
         </div>
     </div> <!-- end col -->
 </div> <!-- end row -->


 <div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mt-0" id="myModalLabel">Add User</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body form">
				<form method="post" id="form" class="form-horizontal">
					<input type="hidden" value="" name="id" />
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-9">
								<input name="id" class="form-control" type="hidden">
								<span class="help-block" style="color:red"></span>
							</div>
						</div>

						<div class="mb-3 row">
							<div class="mb-3 row">
								<label for="nama" class="col-md-4 col-form-label">Nama</label>
								<div class="col-md-8">
									<input class="form-control" type="text" id="nama" name="nama" placeholder="Nama">
									<span class="help-block" style="color:red"></span>
								</div>
							</div>
						</div>


						<div class="mb-3 row">
							<div class="mb-3 row">
								<label for="stok" class="col-md-4 col-form-label">Stok</label>
								<div class="col-md-8">
									<input class="form-control" type="text" id="stok" name="stok"
										placeholder="Stok Barang">
									<span class="help-block" style="color:red"></span>
								</div>
							</div>
						</div>

						<div class="mb-3 row">
							<div class="mb-3 row">
								<label for="harga" class="col-md-4 col-form-label">Harga</label>
								<div class="col-md-8">
									<input type="text" placeholder="Harga" id="harga" name="harga" class="form-control">
									<span class="help-block" style="color:red"></span>
								</div>
							</div>
						</div>

                        <div class="mb-3 row">
							<div class="mb-3 row">
								<label for="harga" class="col-md-4 col-form-label">Tanggal Masuk</label>
								<div class="col-md-8">
									<input type="text" placeholder="Tanggal masuk" id="tanggal_masuk" name="tanggal_masuk" class="form-control">
									<span class="help-block" style="color:red"></span>
								</div>
							</div>
						</div>

						<div class="mb-3 row">
							<div class="mb-3 row">
								<label for="image" class="col-md-4 col-form-label">Upload Photo</label>
								<div class="col-md-8">
									<input class="form-control" type="file" id="foto_barang" name="foto_barang">
									<span class="help-block" style="color:red"></span>
								</div>
							</div>
						</div>

						<div class="mb-3 row">
							<div class="mb-3 row" id="photo-preview">
								<label for="photo" class="col-md-4 col-form-label">Photo</label>
								<div class="col-md-9">
									(No photo)
									<span class="help-block" style="color:red"></span>
								</div>
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-responsive"
					redirect(site_url().'user/userList');>Simpan </button> <button type="button"
					class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
    var base_url = '<?php echo base_url(); ?>';
	var save_method;
	var table;

    $(document).ready(function () {
        table = $('#table').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?php echo base_url('admin/ajax_list') ?>",
            "type": "POST"
        },

        "columnDefs": [{
                "targets": [0],
                "orderable": false,
            },
            {
                "targets": [-1],
                "orderable": false,
            },
        ],

        });

        function add_user() {
            save_method = 'add';
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Add barang');

            $('#photo-preview').hide(); // hide photo preview modal

            $('#label-photo').text('Upload Photo'); // label photo upload
        }

    });
</script>