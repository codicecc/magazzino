<h2>Listing Codecompetitors</h2>
<br>
<?php if ($codecompetitors): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codesource</th>
			<th>Codecompetitor</th>
			<th>Note</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($codecompetitors as $item): ?>		<tr>

			<td><?php echo Model_Codesource::find($item->codesource_id)->title; ?></td>
			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->note; ?></td>
			<td>
				<?php echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array('View','view'),array('Edit','edit'),array('Delete','delete'),));?>			
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Codecompetitors.</p>

<?php endif; ?>
<?php if(Auth::has_access(Request::active()->controller.'.create')):?>
<p>
	<?php echo Html::anchor('admin/codecompetitor/create', 'Add new Codecompetitor', array('class' => 'btn btn-success')); ?>
</p>
<?php endif;?>
