<h2><?php echo $subtitle;?></h2>
<br>
<?php

?>
<?php if ($result): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codice Ecommerce <?php if($mc==1)echo"| <a href=\"/admin/tools/mage_sync_ecommerce_zero_qty/\">Azzera Quantità di questi codici";?></th>
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
