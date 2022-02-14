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
	
							<button class="btn btn-info btn-responsive" data-toggle="tooltip" data-placement="top"
								title="Reload" onclick="reload_table()"><i class="uil-sync"></i> Reload</button>
							<button id="deleteList" class="btn btn-danger btn-responsive" data-toggle="tooltip"
								data-placement="right" title="Delete List" style="display: none;"
								onclick="deleteList()"><i class="uil-trash-alt"></i> Delete List</button>

						</div>
					</div>
				</div>

				<table id="table" class="table table-striped table-bordered dt-responsive nowrap"
					style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th><input type="checkbox" id="check-all"></th>
                            <th>Kode Transaksi</th>
							<th>Harga</th>
							<th>Jumlah Beli</th>
                            <th>Total Harga</th>
                            <th>Tanggal Transaksi</th>
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

<?php $this->load->view("admin/transaksi/detail.php") ?>

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
				"url": "<?php echo base_url('transaksi/ajax_list') ?>",
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


	function reload_table() {
		table.ajax.reload(null, false);
		$('#deleteList').hide();
	}

	function delete_transaksi(id_transaksi) {

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
					url: "<?php echo base_url('transaksi/ajax_delete') ?>/" + id_transaksi,
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
						url: "<?php echo base_url('transaksi/ajax_list_delete') ?>",
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


	function view_transaksi(id) {
		$.ajax({
			url: "<?php echo base_url('transaksi/get_transaksi_result') ?>/" +  id_transaksi,
			method: "POST",
			data: {
				id:  id_transaksi
			},
			success: function (data) {
				$('#transaksi_result').html(data);
				$('#transaksiModal').modal('show');
				$('.modal-title').text('transaksi Details');
			}

		});
	}

</script>
