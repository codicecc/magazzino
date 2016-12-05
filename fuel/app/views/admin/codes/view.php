<h2>Viewing #<?php echo $code->id; ?></h2>

<p>
	<strong>Store (Magazzino):</strong>
	<?php echo $code->store->name; ?></p>
<p>
	<strong>Codice:</strong>
	<?php echo $code->code; ?></p>
<p>
	<strong>Posizione:</strong>
	<?php echo $code->position; ?></p>	
<p>
	<strong>Attivo:</strong>
	<?php echo $code->active?"Si":"No"; ?></p>

<?php if(Auth::has_access(Request::active()->controller.'.edit')):?>
	<?php echo Html::anchor('admin/codes/edit/'.$code->id, 'Edit'); ?> |
<?php endif;?>
<?php echo Html::anchor('admin/codes', 'Back'); ?>