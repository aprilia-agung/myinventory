<?php
if($state == 'edit'){
	$id = $category['category_id'];
	$code = $category['category_code'];
	$name = $category['category_name'];
}else{
	$id = '';
	$code = '';
	$name = '';
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
			<label class="control-label col-sm-4" for="cat_code">Category Code</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="cat_code" name="cat_code" value="<?php echo $code; ?>" pattern="[\w\d]{1,20}" required>
				<input type="hidden"id="cat_id" name="cat_id" value="<?php echo $id; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="cat_name">Category Name</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="cat_name" name="cat_name" value="<?php echo $name; ?>" pattern="[\w\s\d]{1,255}" required>
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