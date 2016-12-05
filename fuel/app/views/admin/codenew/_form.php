<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Codesource id', 'codesource_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('codesource_id', Input::post('codesource_id', isset($codenew) ? $codenew->codesource_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Codesource id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($codenew) ? $codenew->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>