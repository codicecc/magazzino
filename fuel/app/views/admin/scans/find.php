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
				<?php echo Html::anchor('admin/scans/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/scans/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/scans/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>
			</td>
		</tr>
<?php endforeach; ?>
 		<tr>
 			<td colspan="7">
 				<?php //echo Pagination::instance('mypagination')->render();?>
 			</td>
 		</tr>
</tbody>
</table>

<?php else: ?>
<p>No Scans.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/scans/create', 'Add new Scan', array('class' => 'btn btn-success')); ?>

</p>
