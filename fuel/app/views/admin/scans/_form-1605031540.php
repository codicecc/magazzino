<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Utente', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::select('user_id', Input::post('user_id', isset($scan) ? $scan->user_id :  $current_user->id), $users,array('class' => 'span3 col-md-4 form-control', 'placeholder'=>'User')); ?>
				
		</div>
		<div class="form-group">
			<?php echo Form::label('Codice', 'code_id', array('class'=>'control-label')); ?>

				<?php echo Form::select('code_id', Input::post('code_id', isset($scan) ? $scan->code_id : Input::get('code_id')), $codes,array('class' => 'span3 col-md-4 form-control', 'placeholder'=>'User')); ?>
<p>Disponibilità: <?php echo Quantities::quantity(Input::get('code_id'));?></p>
		</div>
		<div class="form-group">
			<?php echo Form::label('Quantità', 'quantity', array('class'=>'control-label')); ?>

				
				<?php	$aquantity=array();for($i=0;$i<1000;$i++){array_push($aquantity,$i);} ?>
				<?php echo Form::select('quantity', Input::post('quantity', isset($scan) ? $scan->quantity : 1), $aquantity, array('class' => 'span3 col-md-4 form-control')); ?>
				
		</div>
		<div class="form-group">
			<?php echo Form::label('Scarico', 'quantity_less', array('class'=>'control-label')); ?>

				<?php echo Form::checkbox('quantity_less', 1,
					Input::post('quantity_less', isset($scan) ? $scan->quantity_less : 0), array('class' => 'col-md-4 form-control mycheckbox')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php 
if(Input::get('code_id'))echo Form::hidden('phonescan','1'); ?>	
<?php echo Form::close(); ?>