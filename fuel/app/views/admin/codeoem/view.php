<h2>Viewing #<?php echo $codeoem->id; ?></h2>

<p>
	<strong>Codesource id:</strong>
	<?php echo $codeoem->codesource_id; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $codeoem->title; ?></p>

<?php if(Auth::has_access(Request::active()->controller.'.edit')):?>
	<?php echo Html::anchor('admin/codeoem/edit/'.$codeoem->id, 'Edit'); ?> |
<?php endif;?>	
<?php echo Html::anchor('admin/codeoem', 'Back'); ?>