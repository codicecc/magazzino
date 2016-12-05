<h2>Editing Code</h2>
<br>

<?php echo render('admin/codes/_form'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
	<?php echo Html::anchor('admin/codes/view/'.$code->id, 'View'); ?> |
<?php endif;?>	
	<?php echo Html::anchor('admin/codes', 'Back'); ?></p>
