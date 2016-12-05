<h2>Editing Codesource</h2>
<br>

<?php echo render('admin/codesource/_form'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
	<?php echo Html::anchor('admin/codesource/view/'.$codesource->id, 'View'); ?> |
<?php endif;?>	


	<?php echo Html::anchor('admin/codesource', 'Back'); ?></p>
