<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-flex align-items-center justify-content-between">
			<h4 class="mb-0"><?= $title; ?></h4>

			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
					<li class="breadcrumb-item active"><?= $title; ?></li>
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
								data-placement="top" title="Tambah barang" onclick="add_barang()"><i
									class="uil-plus-circle"></i> Add barang</button>
							<button class="btn btn-info btn-responsive" data-toggle="tooltip" data-placement="top"
								title="Reload" onclick="reload_table()"><i class="uil-sync"></i> Reload</button>
							<button id="deleteList" class="btn btn-danger btn-responsive" data-toggle="tooltip"
								data-placement="right" title="Delete List" style="display: none;"
								onclick="deleteList()"><i class="uil-trash-alt"></i> Delete List</button>

						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-2">
						<span>Pilih dari tanggal</span>
						<div class="input-group">
							<input type="text" class="form-control pickdate dari_tanggal" name="dari_tanggal" >
				    <span class=" input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
					<div class="col-md-2">
						<span>Sampai tanggal</span>
						<div class="input-group">
							<input type="text" class="form-control pickdate sampai_tanggal" name="sampai_tanggal">
							<span class="input-group-addon" id="basic-addon2"><span
									class="glyphicon glyphicon-calendar"></span></span>
						</div>
					</div>
				</div>

				<p class="card-title-desc">Dibawah ini merupakan daftar seluruh barang.
				</p>

				<table id="table" class="table table-striped table-bordered dt-responsive nowrap"
					style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th><input type="checkbox" id="check-all"></th>
							<th>Foto</th>
							<th>Nama Barang</th>
							<th>Harga</th>
							<th>Stok</th>
                            <th>Tanggal Masuk</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
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
				<h5 class="modal-title mt-0" id="myModalLabel">Add barang</h5>
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
					redirect(site_url().'barang');>Simpan </button> <button type="button"
					class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<style>
	.datepicker {
		z-index: 1100 !important;
	}

</style>

<?php $this->load->view("admin/barang/detail.php") ?>

<script language="JavaScript" type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
	var save_method;
	var table;

	$(document).ready(function () {
		table = $('#table').DataTable({

			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?php echo base_url('barang/ajax_list') ?>",
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

        $.fn.dataTable.ext.search.push(
			function(settings, data, dataIndex) {
			  var min = $('.dari_tanggal').val();
			  var max = $('.sampai_tanggal').val();
			  var createdAt = data[4];  // -> rubah angka 4 sesuai posisi tanggal pada tabelmu, dimulai dari angka 0
			  if (
			    (min == "" || max == "") ||
			    (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
			  ) {
			    return true;
			  }
			  return false;
			}
		);
	    $('.pickdate').each(function() {
	        $(this).datepicker({format: 'yyyy/mm/dd'});
	     });
		$('.pickdate').change(function() {
	        table.draw();
	    });	

		$("input").change(function () {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("textarea").change(function () {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function () {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
			showBottomDelete();
		});

          //datepicker

         //datepicker
         $('input[name="tanggal_masuk"]').datepicker({
            autoclose: false,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

          $('input[name="dari_tanggal"]').datepicker({
            autoclose: false,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

        $('input[name="sampai_tanggal').datepicker({
            autoclose: false,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

	});

	function showBottomDelete() {
		var total = 0;

		$('.data-check').each(function () {
			total += $(this).prop('checked');
		});

		if (total > 0)
			$('#deleteList').show();
		else
			$('#deleteList').hide();
	}

	function add_barang() {
		save_method = 'add';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form').modal('show');
		$('.modal-title').text('Add barang');

		$('#photo-preview').hide(); // hide photo preview modal

		$('#label-photo').text('Upload Photo'); // label photo upload
	}

	function edit_barang(id) {
		save_method = 'update';
		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url: "<?php echo base_url('barang/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function (data) {

				$('[name="id"]').val(data.id);
				$('[name="nama"]').val(data.nama);
				$('[name="stok"]').val(data.stok);
				$('[name="harga"]').val(data.harga);
                $('[name="tanggal_masuk"]').datepicker('update', data.tanggal_masuk);

				$('#modal_form').modal('show');
				$('.modal-title').text('Edit barang');

				$('#photo-preview').show(); // show photo preview modal

				if (data.foto_barang) {
					$('#label-photo').text('Change Photo'); // label photo upload
					$('#photo-preview div').html('<img width="100px" height="150px" src="' + base_url +
						'/assets/images/uploads/barang/' + data.foto_barang + '" class="img-thumbnail">'
						); // show photo
					$('#photo-preview div').append(' <input type="checkbox" name="remove_photo" value="' + data
						.foto_barang + '"/> Remove photo when saving'); // remove photo

				} else {
					$('#label-photo').text('Upload Photo'); // label photo upload
					$('#photo-preview div').text('(No photo)');
				}

			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table() {
		table.ajax.reload(null, false);
		$('#deleteList').hide();
	}

	function save() {
		$('#btnSave').text('saving...');
		$('#btnSave').attr('disabled', true);
		var url;
		if (save_method == 'add') {
			url = "<?php echo base_url('barang/ajax_add') ?>";
		} else {
			url = "<?php echo base_url('barang/ajax_update') ?>";
		}

		var formData = new FormData($('#form')[0]);
		$.ajax({
			url: url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function (data) {

				if (data.status) {
					$('#modal_form').modal('hide');
					reload_table();
					Swal.fire(
						'Good job!',
						'Data has been save!',
						'success'
					)
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						$('[name="' + data.inputerror[i] + '"]').parent().parent().addClass(
						'has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[
						i]); //select span help-block class set text error string
					}
				}
				$('#btnSave').text('Simpan');
				$('#btnSave').attr('disabled', false);


			},
			error: function (jqXHR, textStatus, errorThrown) {
				alert('Error adding / update data');
				$('#btnSave').text('Simpan');
				$('#btnSave').attr('disabled', false);

			}
		});
	}

	function delete_barang(id) {

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			closeOnConfirm: false
		}).then(function (isConfirm) {
			if (isConfirm.value) {

				$.ajax({
					url: "<?php echo base_url('barang/ajax_delete') ?>/" + id,
					type: "POST",
					dataType: "JSON",
					success: function (data) {
						$('#modal_form').modal('hide');
						reload_table();
						Swal.fire(
							'Deleted!',
							'Your file has been deleted.',
							'success'
						);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						alert('Error adding / update data');
					}
				});
			} else if (isConfirm.dismiss === Swal.DismissReason.cancel) {
				Swal.fire({
					title: "Batal Hapus",
					text: "Data batal dihapus :)",
					showConfirmButton: false,
					timer: 2000,
					icon: "success"
				});
			}
		})
	}

	function deleteList() {
		var list_id = [];
		$(".data-check:checked").each(function () {
			list_id.push(this.value);
		});
		if (list_id.length > 0) {
			Swal.fire({
				title: 'Are you sure delete ' + list_id.length + ' data?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: "Tidak, Batalkan Hapus",
				closeOnConfirm: false,
				closeOnCancel: false
			}).then(function (isConfirm) {
				if (isConfirm.value) {

					$.ajax({
						data: {
							id: list_id
						},
						url: "<?php echo base_url('barang/ajax_list_delete') ?>",
						type: "POST",
						dataType: "JSON",
						success: function (data) {
							$('#modal_form').modal('hide');
							reload_table();
							Swal.fire({
								title: "Deleted!",
								text: "Your file has been deleted.",
								showConfirmButton: false,
								timer: 2000,
								icon: "success"
							});
						},
						error: function (jqXHR, textStatus, errorThrown) {
							alert('Error deleting data');
						}
					});
				} else if (isConfirm.dismiss === Swal.DismissReason.cancel) {
					Swal.fire({
						title: "Batal Hapus",
						text: "Data batal dihapus :)",
						showConfirmButton: false,
						timer: 2000,
						icon: "success"
					});
				}
			});
		} else {
			alert('no data selected');
		}
	}


	function view_barang(id) {
		$.ajax({
			url: "<?php echo base_url('barang/get_barang_result') ?>/" + id,
			method: "POST",
			data: {
				id: id
			},
			success: function (data) {
				$('#barang_result').html(data);
				$('#barangModal').modal('show');
				$('.modal-title').text('barang Details');
			}

		});
	}

</script>
