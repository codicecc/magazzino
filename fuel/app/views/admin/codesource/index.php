<h2>Listing Codesources</h2>
<br>
<?php if ($codesources): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($codesources as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td>
				<?php echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array('View','view'),array('Edit','edit'),array('Delete','delete'),));?>			
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Codesources.</p>

<?php endif; ?><p>
<?php if(Auth::has_access(Request::active()->controller.'.create')):?>
	<?php echo Html::anchor('admin/codesource/create', 'Add new Codesource', array('class' => 'btn btn-success')); ?>
<?php endif;?>
</p>
