<h2>Viewing #<?php echo $scan->id; ?></h2>

<p>
	<strong>Utente:</strong>
	<?php echo $scan->user->username; ?></p>
<p>
	<strong>Codice:</strong>
	<?php echo Model_Code::find($scan->code->id)->store['name']." ".$scan->code->code." posizione ".$scan->code->position; ?></p>
<p>
	<strong>Quantità:</strong>
	<?php echo $scan->quantity; ?></p>
<p>
	<strong>Tipo di Azione:</strong>
	<?php echo $tmp=$scan->quantity_less?"Scarico":"Carico"; ?></p>
<p>
	<strong>Creazione:</strong>
	<?php echo date('d/m/y H:i:s',$scan->created_at); ?></p>
<p>
	<strong>Ultima Modifica:</strong>
	<?php echo date('d/m/y H:i:s',$scan->updated_at); ?></p>

<?php if(Auth::has_access(Request::active()->controller.'.edit')):?>
<?php echo Html::anchor('admin/scans/edit/'.$scan->id, 'Edit'); ?> |
<?php endif;?>
<?php echo Html::anchor('admin/scans', 'Back'); ?>