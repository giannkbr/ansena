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