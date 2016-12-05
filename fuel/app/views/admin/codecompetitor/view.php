<h2>Viewing #<?php echo $codecompetitor->id; ?></h2>

<p>
	<strong>Codesource id:</strong>
	<?php echo $codecompetitor->codesource_id; ?></p>
<p>
	<strong>Title:</strong>
	<?php echo $codecompetitor->title; ?></p>
<p>
	<strong>Note:</strong>
	<?php echo $codecompetitor->note; ?></p>

<?php if(Auth::has_access(Request::active()->controller.'.edit')):?>
	<?php echo Html::anchor('admin/codecompetitor/edit/'.$codecompetitor->id, 'Edit'); ?> |
<?php endif;?>	
<?php echo Html::anchor('admin/codecompetitor', 'Back'); ?>