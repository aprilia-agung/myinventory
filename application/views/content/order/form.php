<?php
if($this->session->has_userdata('items_order'))
	$this->session->unset_userdata('items_order');
if($state == 'edit'){
	$id = $order['order_id'];
	$date = $order['order_date'];
	$supp = $order['order_supplier'];
	$ongkir = $order['order_shipping'];
}else{
	$id = '';
	$date = date('d-m-Y');
	$supp = '';
	$ongkir = 0;
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
		<div class="box box-primary">
			<div class="box-header"><h3 class="box-title">Item Order</h3></div>
			<div class="box-body">
				<?php echo form_open('', 'class="form" role="form" id="frmitemorder"') ?>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="product" name="product" pattern="[\w\s\d]{1,255}" placeholder="Product name.." required>
				</div>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="qty" name="qty" pattern="[\d]{1,3}" placeholder="Qty" required>
				</div>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="price" name="price" pattern="[\d]{1,20}" placeholder="Price per item.." required>
				</div>
				<div class="col-sm-1">
					<button type="submit" id="btn-add-item" class="btn btn-primary"><i class="fa fa-plus"></i></button>
				</div>
				<br /><br /><br />
				<table class="table table-striped" id="tbitemorder">
					<thead>
						<tr>
							<th>#</th>
							<th>Item Name</th>
							<th>Qty</th>
							<th>Price Per Item</th>
							<th>Sub Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="box box-primary">
			<div class="box-header"><h3 class="box-title">Detail Order</h3></div>
			<div class="box-body">
				<?php echo form_open(site_url($this->uri->segment(1).'/'.$action), 'role="form" class="form" id="frmdetailorder"')?>
				<div class="form-group">
					<label class="control-label" for="order_date">Order Date</label>
					<input type="text" class="form-control" id="order_date" name="order_date" value="<?php echo $date; ?>" pattern="[\d\-]{1,10}" required>
				</div>
				<div class="form-group">
					<label class="control-label" for="order_date">Supplier</label>
					<select class="form-control" id="supplier" name="supplier" required>
					<?php if(isset($supplier)){ foreach($supplier as $val){?>
						<option value="<?php echo $val['supplier_id']; ?>" <?php echo $val['supplier_id'] == $supp? 'selected' : ''; ?>><?php echo $val['supplier_name']; ?></option>
					<?php }} ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label" for="ongkir">Shipping Cost</label>
					<input type="text" class="form-control" id="ongkir" name="ongkir" pattern="[\d]{1,10}" required>
				</div>
			</div>
			<div class="box-footer">
				<div class="form-group pull-right">
						<input type="hidden"id="order_id" name="order_id" value="<?php echo $id; ?>">
						<button type="button" class="btn btn-default" onclick="javascript:window.history.back()">Back</button>
						<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<link href="<?php echo base_url('assets/');; ?>/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('assets/');; ?>/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/'); ?>/plugins/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<style type="text/css">
.autocomplete-suggestions { border: 1px solid #3C8DBC; background: #FFF; overflow: auto; width: 260px !important;}
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('#order_date').datepicker({
		format: 'dd-mm-yyyy'
	});

	$('#product').autocomplete({
	    serviceUrl: '<?php echo site_url('common/get_product') ?>',
	    onSelect: function (suggestion) {
	        //$('#jabatan').val(suggestion.data);
	    }
	});
	
	$('#frmitemorder').on('submit', function(evt){
		$.post('<?php echo site_url($this->uri->segment(1).'/add_item')?>', $(this).serialize() , function(data){
			$("#tbitemorder tbody").html(data);
			$('#frmitemorder')[0].reset();
		})
		evt.preventDefault();
	});

	$('body').delegate('.delete_item', 'click', function(evt){
		$.get($(this).attr('href'), function(data){
			$("#tbitemorder tbody").html(data);
		});
		evt.preventDefault();
	});
});
</script>