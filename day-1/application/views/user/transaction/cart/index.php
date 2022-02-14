 <!-- Breadcrumb -->
 <section id="breadcrumb" class="bg-white py-5">
     <div class="container">
         <div class="row">
             <divc class="col">
                 <p class="text-secondary fw-light">Home / <span class="yellow-text">Keranjang</span></p>
             </divc>
         </div>
     </div>
 </section>
 <!-- Akhir Breadcrumb -->
 <!-- Keranjang -->
 <section id="keranjang" class="bg-white py-5 my-5">
     <div class="container" id="detail_cart">
     </div>
 </section>
 <!-- Akhir Keranjang -->

 <!-- Check -->
 <section class="bg-white py-5 " id="total_cart">


 </section>
 <!-- Akhir Check -->

 <!-- Modal Hapus -->
 <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                 <button type="button" class="btn btn-danger">Hapus</button>
             </div>
         </div>
     </div>
 </div>
 <!-- Akhir Modal Hapus -->
 <!-- End OF Modal -->

 <!-- Akhir Produk Serupa -->
 <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
 <script>
     //Tampil Cart
     $(document).ready(function() {
         $('#detail_cart').load("<?php echo base_url(); ?>user/cart/load_cart");
     });
     //End Tampil Cart

     //tampil total
     $(document).ready(function() {
         $('#total_cart').load("<?php echo base_url(); ?>user/cart/load_total");

     });
     //end tampil total


     $(document).on('click', '.tambah_qty', function() {
         let row_id = $(this).attr("id"); //mengambil row_id dari artibut id
         let qty = $(this).data("qty");
         $.ajax({
             url: "<?php echo base_url(); ?>user/cart/tambah_qty",
             method: "POST",
             data: {
                 row_id: row_id,
                 qty: qty
             },
             success: function(data) {
                 $('#detail_cart').html(data);
                 $('#total_cart').load("<?php echo base_url(); ?>user/cart/load_total");
                 $('#total_items').load("<?php echo base_url(); ?>user/cart/load_items");
             }
         });
     });

     $(document).on('click', '.kurang_qty', function() {
         let row_id = $(this).attr("id"); //mengambil row_id dari artibut id
         let qty = $(this).data("qty");
         $.ajax({
             url: "<?php echo base_url(); ?>user/cart/kurang_qty",
             method: "POST",
             data: {
                 row_id: row_id,
                 qty: qty
             },
             success: function(data) {
                 $('#detail_cart').html(data);
                 $('#total_cart').load("<?php echo base_url(); ?>user/cart/load_total");
                 $('#total_items').load("<?php echo base_url(); ?>user/cart/load_items");
             }
         });
     });

     //untuk hapus cart
     $(document).on('click', '.hapus_cart', function() {
         let row_id = $(this).attr("id"); //mengambil row_id dari artibut id
         confirm('Anda Yakin Ingin Menghapus?')
         $.ajax({
             url: "<?php echo base_url(); ?>user/cart/hapus_cart",
             method: "POST",
             data: {
                 row_id: row_id
             },
             success: function(data) {
                 $('#detail_cart').html(data);
                 $('#total_cart').load("<?= base_url(); ?>user/cart/load_total");
                 $('#total_items').load("<?= base_url(); ?>user/cart/load_items");
             }
         });
     });
 </script>