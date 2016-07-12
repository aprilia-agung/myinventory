<?php
if($state == 'edit'){
	$id = $suppliers['supplier_id'];
	$code = $suppliers['supplier_code'];
	$name = $suppliers['supplier_name'];
	$address = $suppliers['supplier_address'];
	$phone = $suppliers['supplier_phone'];
}else{
	$id = '';
	$code = '';
	$name = '';
	$address = '';
	$phone = '';
}
?>
<div class="row">
	<?php if($this->session->flashdata() != NULL){ ?>
		<div class="alert alert-<?php echo $this->session->flashdata('notif_status') == true ? 'success' : 'danger' ; ?> text-center alert-dismissable col-lg-12">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $this->session->flashdata('notif_msg') ?>
		</div>
	<?php } ?>
	<div class="col-lg-8">
	<?php echo form_open(site_url($this->uri->segment(1).'/'.$action), 'role="form" class="form form-horizontal"')?>
		<div class="form-group">
			<label class="control-label col-sm-4" for="supp_code">Supplier Code</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="supp_code" name="supp_code" value="<?php echo $code; ?>" pattern="[\w\d]{1,20}" required>
				<input type="hidden"id="supp_id" name="supp_id" value="<?php echo $id; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="supp_name">Supplier Name</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="supp_name" name="supp_name" value="<?php echo $name; ?>" pattern="[\w\s\d]{1,255}" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="supp_address">Supplier Address</label>
			<div class="col-sm-8">
				<textarea class="form-control" rows="3" id="supp_address" name="supp_address" pattren="[\w\d\s\-\'\.\,]{1,255}" required><?php echo $address; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="supp_phone">Supplier Phone</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="supp_phone" name="supp_phone" value="<?php echo $phone; ?>" pattern="[\d\s\+\(\)]{1,255}" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="button" class="btn btn-default" onclick="javascript:window.history.back()">Back</button>
			</div>
		</div>
	<?php echo form_close(); ?>
	</div>
</div>