<h2>Strumenti, utilità</h2>
<br>

<?php
?>
<?php if ($codes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Store (Magazzino)</th>
			<th>Code (Codice)</th>
			<th>NUOVO CODICE</th>
			<th>Quantità Magazzino</th>
			<th>Quantità Ecommerce</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($codes as $item): ?>		<tr id="<?php echo utilities::standardize2($item->code);?>" class="anchor">
			<td><?php echo $item->store['name'] ?></td>
			<td><?php echo $item->code; ?></td>
			<?php $tcode=Codes::checkCode(Utilities::standardize2($item->code))?Codes::getNewCode(Utilities::standardize2($item->code)):$item->code;?>
			<td><?php echo $tcode; ?></td>
			<td><?php echo Quantities::quantity_by_code($item->id)?></td>
			<td><?php echo Arraytools::asearch($ecommerce,strtoupper(str_replace(" ","",$tcode)));?></td>
			<td><a href="/admin/tools/mageChangeQty/<?php echo utilities::standardize2($tcode);?>/<?php echo Quantities::quantity_by_code($item->id);?>">Aggiorna</a></td>
		</tr>		
<?php endforeach; ?>
 	</tbody>
</table>

<?php else: ?>
<p>Nothing.</p>

<?php endif; ?>

<script>
$(function(){
		var hash = location.hash.substring(1);
		$('html, body').animate({
        scrollTop: $("#"+hash).offset().top -100
    }, 2000);
});
</script>
