<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Store (Magazzino)', 'store_id', array('class'=>'control-label')); ?>

				<?php echo Form::select('store_id', Input::post('store_id', isset($code) ? $code->store_id : ''), $stores, array('class' => 'col-md-4 form-control', 'placeholder'=>'Store (Magazzino)')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Codice', 'code', array('class'=>'control-label')); ?>

				<?php echo Form::input('code', Input::post('code', isset($code) ? strtoupper($code->code) : ''), array('class' => 'uppercase col-md-4 form-control', 'placeholder'=>'Codice')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Posizione', 'position', array('class'=>'control-label')); ?>

				<?php echo Form::input('position', Input::post('position', isset($code) ? strtoupper($code->position) : ''), array('class' => 'uppercase col-md-4 form-control', 'placeholder'=>'Posizione')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Attivo', 'active', array('class'=>'control-label')); ?>

					<?php echo Form::checkbox('active', 1,
					Input::post('active', isset($code) ? $code->active : 1), array('class' => 'col-md-4 form-control mycheckbox')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
			</div>
	</fieldset>
<?php echo Form::close(); ?>
