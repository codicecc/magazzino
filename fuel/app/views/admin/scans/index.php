<h2>Listing Scans</h2>
<br>
<?php if ($scans): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Utente</th>
			<th>Codice</th>
			<th>Quantità</th>
			<th>Tipo di azione</th>
			<th>Creazione</th>
			<th>Ultima Modifica</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($scans as $item): ?>		<tr>

<?php //echo(Model_Code::find($item->code->id));?>

			<td><?php echo $item->user->username; ?></td>
			<td><?php echo Model_Code::find($item->code->id)->store['name']." ".$item->code->code." posizione: ".$item->code->position; ?></td>
			<td><?php echo $item->quantity; ?></td>
			<td><?php echo $tmp=$item->quantity_less?"Scarico":"Carico"; ?></td>
			<td><?php echo date('d/m/y H:i:s',$item->created_at); ?></td>
			<td><?php echo date('d/m/y H:i:s',$item->updated_at); ?></td>
			<td>
			
			<?php echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array('View','view'),array('Edit','edit'),array('Delete','delete')));?>

			</td>
		</tr>
<?php endforeach; ?>
 		<tr>
 			<td colspan="7">
 				<?php echo Pagination::instance('mypagination')->render();?>
 			</td>
 		</tr>
</tbody>
</table>

<?php else: ?>
<p>No Scans.</p>

<?php endif; ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.create')):?>
	<?php echo Html::anchor('admin/scans/create', 'Add new Scan', array('class' => 'btn btn-success')); ?>
<?php endif;?>
</p>
