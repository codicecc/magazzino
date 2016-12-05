<h2>Viewing #<?php echo $store->id; ?></h2>

<p>
	<strong>Name:</strong>
	<?php echo $store->name; ?></p>
<p>
	<strong>Note:</strong>
	<?php echo $store->note; ?></p>
<?php if(Auth::has_access(Request::active()->controller.'.edit')):?>	
<?php echo Html::anchor('admin/stores/edit/'.$store->id, 'Edit'); ?> |
<?php endif;?>
<?php echo Html::anchor('admin/stores', 'Back'); ?>