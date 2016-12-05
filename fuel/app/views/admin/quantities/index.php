<h2>Listing Codes</h2>
		<p>
<?php if(Auth::has_access(Request::active()->controller.'.getcsv')):?>		
	<a class="btn btn-primary btn-lg" href="/admin/quantities/getcsv/2">Scarica il file CSV - Prodotto Finito</a>
<?php endif;?>
		</p>
		<p>
<?php if(Auth::has_access(Request::active()->controller.'.getcsv')):?>
	<a class="btn btn-primary btn-lg" href="/admin/quantities/getcsv/1">Scarica il file CSV - Carcasse</a>
<?php endif;?>	
		</p>
<br>
<?php if ($codes): ?>
Filtra per Magazzino:
<?php echo Html::anchor('/admin/quantities/index/1', 'Carcasse', array('id' => 'getcsv', 'class' => 'getcsv', 'class' => 'btn'));?>
|
<?php echo Html::anchor('/admin/quantities/index/2', 'Prodotto Finito', array('id' => 'getcsv', 'class' => 'getcsv', 'class' => 'btn'));?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Store (Magazzino)</th>
			<th>Code (Codice)</th>
			<th>NUOVO CODICE</th>
			<th>Quantità Disponibile</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($codes as $item): ?>		<tr>
			<td><?php echo $item->store['name'] ?></td>
			<td><?php echo $item->code; ?></td>
			<?php $tcode=Codes::checkCode(Utilities::standardize2($item->code))?Codes::getNewCode(Utilities::standardize2($item->code)):$item->code;?>
			<td><?php echo $tcode; ?></td>
			<td><?php echo Quantities::quantity_by_code($item->id)?></td>
		</tr>
<?php endforeach; ?>
 	</tbody>
</table>

<?php else: ?>
<p>Nothing.</p>

<?php endif; ?>
