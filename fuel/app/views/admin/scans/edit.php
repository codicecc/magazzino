<h2>Editing Scan</h2>
<br>

<?php echo render('admin/scans/_form'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
<?php echo Html::anchor('admin/scans/view/'.$scan->id, 'View'); ?> |
<?php endif;?>
	<?php echo Html::anchor('admin/scans', 'Back'); ?></p>
