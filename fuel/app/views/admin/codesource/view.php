<h2>Viewing #<?php echo $codesource->id; ?></h2>

<p>
	<strong>Title:</strong>
	<?php echo $codesource->title; ?></p>

<?php if(Auth::has_access(Request::active()->controller.'.view')):?>	
	<?php echo Html::anchor('admin/codesource/edit/'.$codesource->id, 'Edit'); ?> |
<?php endif;?>
<?php echo Html::anchor('admin/codesource', 'Back'); ?>