<?php if($this->session->flashdata() != NULL){ ?>
	<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif_msg') ?>
	</div>
<?php } ?>
<div class="row">
	<div class="col-sm-12">
		<a class="btn btn-primary" href="<?php echo site_url($this->uri->segment(1).'/add');?>" role="button" aria-label="Tambah data" data-toggle="tooltip" data-placement="bottom" title="Add Order"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
		
	</div>
	<div class="col-sm-12">&nbsp;</div>
	<div class="col-sm-12">
		<table class="table table-striped table-hover" id="tborder">
			<thead>
				<th>No</th>
				<th>Date</th>
				<th>Supplier</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php $no = 1; ?>
				<?php if(isset($orders)){ foreach ($orders as $val) {?>
					<tr>
						<td><?php echo $no; $no++; ?></td>
						<td><?php echo date('d-m-Y', strtotime($val['order_date'])); ?></td>
						<td><?php echo $val['supplier_name']; ?></td>
						<td>
							<a href="<?php echo site_url($this->uri->segment(1).'/edit?id='.$val['order_id']); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
							<a href="<?php echo site_url($this->uri->segment(1).'/delete?id='.$val['order_id']); ?>" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></a>
							<a href="<?php echo site_url($this->uri->segment(1).'/detail?id='.$val['order_id']); ?>" class="btn btn-success btn-xs"><i class="fa fa-list"></i></a>
						</td>
					</tr>
				<?php }} ?>
			</tbody>
		</table>
	</div>
</div>
<link href="<?php echo base_url('assets/');; ?>/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/');; ?>/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/');; ?>/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#tborder').DataTable({
		responsive: true
	});
});
</script>