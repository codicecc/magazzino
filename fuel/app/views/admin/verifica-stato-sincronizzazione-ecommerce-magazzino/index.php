<h2><?php echo $subtitle;?></h2>
		<p>
<?php if(Auth::has_access(Request::active()->controller.'.getcsv')):?>		
	<a class="btn btn-primary btn-lg" href="/admin/tools/getcsv/<?php echo($mc);?>">Scarica il file CSV</a>
<?php endif;?>
		</p>
<?php

?>
<?php if ($result): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codice Ecommerce <?php if($mc==1&&Auth::has_access(Request::active()->controller.'.mage_sync_ecommerce_zero_qty'))echo"| <a href=\"/admin/tools/mage_sync_ecommerce_zero_qty/\">Azzera Quantità di questi codici";?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($result as $item): ?>		<tr>
			<td><?php echo $item; ?></td>
		</tr>		
<?php endforeach; ?>
 	</tbody>
</table>

<?php else: ?>
<p>Nessun Codice.</p>

<?php endif; ?>
