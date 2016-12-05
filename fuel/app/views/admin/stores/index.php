<h2>Listing Stores</h2>
<br>
<?php if ($stores): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Note</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($stores as $item): ?>		<tr>

			<td class="uppercase"><?php echo $item->name; ?></td>
			<td><?php echo $item->note; ?></td>
			<td>
				<?php echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array('View','view'),array('Edit','edit'),array('Delete','delete'),));?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Stores.</p>

<?php endif; ?><p>
<?php if(Auth::has_access(Request::active()->controller.'.create')):?>
	<?php echo Html::anchor('admin/stores/create', 'Add new Store', array('class' => 'btn btn-success')); ?>
<?php endif;?>

</p>
