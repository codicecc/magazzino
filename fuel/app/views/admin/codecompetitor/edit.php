<h2>Editing Codecompetitor</h2>
<br>

<?php echo render('admin/codecompetitor/_form'); ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.view')):?>	
	<?php echo Html::anchor('admin/codecompetitor/view/'.$codecompetitor->id, 'View'); ?> |
<?php endif;?>	
	<?php echo Html::anchor('admin/codecompetitor', 'Back'); ?></p>
