<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"> </script>
<!-- DataTables -->

<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"> </script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"> </script>

<style>
	tbody.sortable {
		/* change the cursor to 'move' cursor when hovering */
		cursor: move;
	}
	ul.sortable {
		/* change the cursor to 'move' cursor when hovering */
		cursor: move;
	}

	button
	{
		margin-top: 10px;
		margin-left: 10px;
	}
	.btn-xs
	{
		padding: 1px 5px !important;
		font-size: 12px !important;
		line-height: 1.5 !important;
		border-radius: 3px !important;
	}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<!-- For Messages -->
   		<?php $this->load->view('admin/includes/_messages.php') ?>
		<div class="card">
			<div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; <?= $title ?></h3>
				</div>

				<!-- <div class="alert alert-success" id="response" role="alert">Sort and save :)</div> -->
				
				<div class="d-inline-block float-right">
					<button class="save btn btn-success"><i class="fa fa-save"></i><?= trans('update_position') ?></button>
					<!-- <a href="<?= base_url('admin_roles/update_menu_list') ?>" class="btn btn-success"><i class="fa fa-plus"></i><?= trans('update_position') ?></a> -->
					<a href="<?= base_url('admin/admin_roles/module_add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?= trans('add_new_module') ?></a>
				</div>
			</div>

			<div class="card-body">
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="50"><?= trans('id') ?></th>
							<th><?= trans('module_name') ?></th>
							<th><?= trans('controller_name') ?></th>
							<th><?= trans('fa_icon') ?></th>
							<th><?= trans('operations') ?></th>
							<th><?= trans('sub_module') ?></th>
							<th width="100"><?= trans('action') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($records as $record): ?>
							<tr>
								<td><?= $record['module_id']; ?></td>
								<td><?= trans($record['module_name']); ?></td>
								<td><?= $record['controller_name']; ?></td>
								<td><?= $record['fa_icon']; ?></td>
								<td><?= $record['operation']; ?></td>
								<td>
									<a href="<?= base_url('admin/admin_roles/sub_module/'.$record['module_id']) ?>" class="btn btn-info btn-xs mr5">
										<i class="fa fa-sliders"></i>
									</a>
								</td>
								<td>
									<a href="<?php echo site_url("admin/admin_roles/module_edit/".$record['module_id']); ?>" class="btn btn-warning btn-xs mr5" >
											<i class="fa fa-edit"></i>
										</a>
									<a href="<?php echo site_url("admin/admin_roles/module_delete/".$record['module_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
  })
</script>

<script type="text/javascript">
	var ul_sortable = $('.sortable');
	ul_sortable.sortable({
		revert: 100,
		placeholder: 'placeholder'
	});
	ul_sortable.disableSelection();
	var btn_save = $('button.save'),
	div_response = $('#response');
	btn_save.on('click', function(e) {
		e.preventDefault();
		var sortable_data = ul_sortable.sortable( 'serialize' );
		var csrf_name = '<?php echo $CI->security->get_csrf_token_name(); ?>';
		var csrf_hash = '<?php echo $CI->security->get_csrf_hash(); ?>';
		var my_data = csrf_name + "=" + csrf_hash + "&" + "menulist=" + sortable_data;
		div_response.text('Saved!');
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>admin/admin_roles/update_menu_list',
			data: my_data,
			success:function(result) {
				//console.log('Hello');
				alert('re-order completed, re-loading page.');
				div_response.text(result);
				location.href = '<?= base_url("admin_roles/Admin_roles/module"); ?>';
			},
		});
		error: function(xhr, status, error) {
			console.log("Error: " + error);

		},
		complete: function(data) {
			console.log(data.statusText);
		}
	});
</script>

