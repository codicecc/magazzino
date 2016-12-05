<h2>Viewing #<?php echo $codenew->id; ?></h2>

<p>
	<strong>Codesource id:</strong>
	<?php echo $codenew->codesource_id; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $codenew->title; ?></p>

<?php if(Auth::has_access(Request::active()->controller.'.edit')):?>
	<?php echo Html::anchor('admin/codenew/edit/'.$codenew->id, 'Edit'); ?> |
<?php endif;?>
<?php echo Html::anchor('admin/codenew', 'Back'); ?>