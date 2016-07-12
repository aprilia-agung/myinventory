<?php

echo $order['order_date']."<br>";
echo $order['supplier_name']."<br>";
if(isset($item_order)){
	foreach ($item_order as $i) {
		echo $i['product_name']."<br>";
		echo "<img src='".site_url('common/generate_barcode?code='.$i['sku'])."'><br>";
	}
}
?>