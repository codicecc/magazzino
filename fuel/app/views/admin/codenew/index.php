<h2>Listing Codenews</h2>
<br>
<?php if ($codenews): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codesource</th>
			<th>Title</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($codenews as $item): ?>		<tr>

			<td><?php echo Model_Codesource::find($item->codesource_id)->title; ?></td>
			<?php //$item->codesource_id;?>
			<td><?php echo $item->title; ?></td>
			<td>
				<?php echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array('View','view'),array('Edit','edit'),array('Delete','delete'),));?>			
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Codenews.</p>

<?php endif; ?>
<?php if(Auth::has_access(Request::active()->controller.'.create')):?>
<p>
	<?php echo Html::anchor('admin/codenew/create', 'Add new Codenew', array('class' => 'btn btn-success')); ?>

</p>
<?php endif;?>
