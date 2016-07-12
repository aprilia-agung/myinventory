<?php
if($state == 'edit'){
	$id = $product['product_id'];
	$code = $product['product_code'];
	$name = $product['product_name'];
	$p_category = $product['product_category'];
	$p_supplier = $product['product_supplier'];
}else{
	$id = '';
	$code = '';
	$name = '';
	$p_category = '';
	$p_supplier = '';
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
			<label class="control-label col-sm-4" for="prod_code">Product Code</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="prod_code" name="prod_code" value="<?php echo $code; ?>" pattern="[\w\d]{1,20}" required>
				<input type="hidden"id="prod_id" name="prod_id" value="<?php echo $id; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="prod_name">Product Name</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="prod_name" name="prod_name" value="<?php echo $name; ?>" pattern="[\w\s\d]{1,255}" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-4" for="prod_cat">Product Category</label>
			<div class="col-sm-8">
				<select class="form-control" name="prod_cat" id="prod_cat" required>
					<?php if(isset($category)){ foreach($category as $cat){ ?>
					<option value="<?php echo $cat['category_id']?>" <?php echo $cat['category_id'] == $p_category? 'selected' : ''; ?>><?php echo $cat['category_name']?></option>
					<?php }} ?>
				</select>
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