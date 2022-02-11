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

                 <?= form_open_multipart('user/edit'); ?>
                 <div class="mb-3 row">
                     <label for="email" class="col-md-2 col-form-label">Email</label>
                     <div class="col-md-5">
                         <input class="form-control" type="email" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="name" class="col-md-2 col-form-label">Full Name</label>
                     <div class="col-md-5">
                         <input class="form-control" type="text" id="name" name="name" value="<?= $user['name']; ?>">
                         <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="example-text-input" class="col-md-2 col-form-label">Picture</label>
                     <div class="col-md-5">
                         <img class="rounded mr-2" alt="200x200" width="200" src="<?= base_url('assets/images/user-auth/') . $user['image']; ?>" data-holder-rendered="true">
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="image" class="col-md-2 col-form-label">Upload</label>
                     <div class="col-md-5">
                         <input class="form-control" type="file" id="image" name="image">
                     </div>
                 </div>
                 <div class="mb-3 row">
                     <label for="" class="col-md-2 col-form-label"></label>
                     <div class="col-md-5">
                         <button type="submit" class="btn btn-primary w-md">Edit Profile</button>
                     </div>
                 </div>
                 </form>
             </div>
         </div>
     </div> <!-- end col -->
 </div>
 <!-- end row -->