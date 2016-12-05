<h2>Editing Store</h2>
<br>

<?php echo render('admin/stores/_form'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>
		<?php echo Html::anchor('admin/stores/view/'.$store->id, 'View'); ?> |
<?php endif;?>
	<?php echo Html::anchor('admin/stores', 'Back'); ?></p>
