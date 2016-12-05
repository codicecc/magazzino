<h2>Editing Codenew</h2>
<br>

<?php echo render('admin/codenew/_form'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
	<?php echo Html::anchor('admin/codenew/view/'.$codenew->id, 'View'); ?> |
<?php endif;?>	
	<?php echo Html::anchor('admin/codenew', 'Back'); ?></p>
