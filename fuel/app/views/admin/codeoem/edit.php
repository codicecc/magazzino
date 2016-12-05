<h2>Editing Codeoem</h2>
<br>

<?php echo render('admin/codeoem/_form'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
	<?php echo Html::anchor('admin/codeoem/view/'.$codeoem->id, 'View'); ?> |
<?php endif;?>	
	<?php echo Html::anchor('admin/codeoem', 'Back'); ?></p>
