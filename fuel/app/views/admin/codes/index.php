<h2>Listing Codes</h2>
<br>
<?php if ($codes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Store (Magazzino)</th>
			<th>Code</th>
			<th>Position</th>
			<th>Active</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($codes as $item): ?>		<tr>

			<td><?php echo $item->store['name'] ?></td>
			<td title="Quantità disponibili totali per <?php echo $item->code; ?>: <?php echo Quantities::quantity_by_code($item->id)?>"><?php echo $item->code; ?></td>
			<td><?php echo $item->position; ?></td>
			<td><?php echo $item->active?"Si":"No"; ?></td>
			<td>	

<?php echo Utilities::adminActions($item,Request::active()->route->segments[1],array(array('View','view'),array('Edit','edit'),array('Delete','delete'),array('QR Code','qrcode')));?>
 |
<?php if(Auth::has_access('Controller_Admin_Scans.find')):?>
<?php echo Html::anchor('admin/scans/find?code_id='.$item->id, 'Dettaglio Scansioni'); ?> |
<?php endif;?>

<?php if(Auth::has_access('Controller_Admin_Quantities.quantity')):?>
<?php echo "Quantità disponibili: <strong>".Quantities::quantity($item->id)."</strong>";?> |
<?php endif;?>		

			</td>
		</tr>
<?php endforeach; ?>
 		<tr>
 			<td colspan="5">
 				<?php echo Pagination::instance('mypagination')->render();?>
 			</td>
 		</tr>
 	</tbody>
</table>

<?php else: ?>
<p>No Codes.</p>

<?php endif; ?>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.getcsv')):?>
<?php echo Html::anchor('/admin/codes/getcsv', 'Scarica CSV COMPLETO', array('id' => 'getcsv', 'class' => 'getcsv', 'class' => 'btn'));?>
<?php echo Html::anchor('/admin/codes/getcsv/2', 'Scarica CSV SOLO PRODOTTO FINITO', array('id' => 'getcsv', 'class' => 'getcsv', 'class' => 'btn'));?>
<?php endif;?>

<?php if(Auth::has_access(Request::active()->controller.'.getcsv')):?>
<?php echo Form::open(array('action' => '/admin/codes/findingbyname',"class"=>"form-inline")); ?>
<div class="col-md-2">
<fieldset>
	<div class="form-group">
		<?php echo Form::select('store_id', Input::post('store_id', isset($code) ? $code->store_id : ''), $stores, array('class' => 'col-md-4 form-control', 'placeholder'=>'Store (Magazzino)')); ?>
	</div>	
</fieldset>
</div>
<div class="col-md-2">
<fieldset>
	<div class="form-group">
		<?php echo Form::input('code', Input::post('code', isset($code) ? strtoupper($code->code) : ''), array('class' => 'uppercase col-md-2 form-control', 'placeholder'=>'Codice')); ?>
	</div>	
</fieldset>
</div>

<div class="col-md-2">
<fieldset>
	<div class="form-group">
		<?php echo Form::input('position', Input::post('position', isset($position) ? strtoupper($position->position) : ''), array('class' => 'uppercase col-md-2 form-control', 'placeholder'=>'Posizione')); ?>
	</div>
</fieldset>
</div>
<div class="col-md-2">
<fieldset>
	<div class="form-group">
		<?php echo Form::label(''); ?>
		<?php echo Form::submit('submit', 'Search', array('class' => 'btn btn-primary')); ?>
	</div>
</fieldset>
</div>
<?php echo Form::close(); ?>
<?php endif;?>
</p>
<p>
<?php if(Auth::has_access(Request::active()->controller.'.create')):?>
<?php echo Html::anchor('admin/codes/create', 'Aggiungi un nuovo Codice', array('class' => 'btn btn-success')); ?>
<?php endif;?>
</p>
