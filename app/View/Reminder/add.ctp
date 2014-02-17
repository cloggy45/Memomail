<section id="add_view">
	
	<h1>Add Reminder</h1>

	<?php echo $this->Form->create('Reminder',array('type' => 'post',
		'inputDefaults' => array(
			'label' => false,
			'div' => false),
		'class' => "form-horizontal",
		'role' => "form"
	)); ?>

	<!-- Title -->
	<div class="form-group">

		<h3>Title</h3>
		<div class="form-input">
			<?php echo $this->Form->input('title', array('type' => 'text','class' => "form-control")); ?>
		</div>
		<p id="remainingTitleChars"></p>

	</div>
	
	<!-- Body -->
	<div class="form-group">

		<h3>Body</h3>

		<div class="form-input">
			<?php echo $this->Form->input('body', array('type' => 'textarea','rows' => '5','class' => "form-control")); ?>
		</div>

		<p id="remainingBodyChars"></p>
	</div>

	<!-- Date-Time -->
	<div class="form-group">

		<h3>Date</h3>
		<div class="form-input">		
			<?php echo $this->Form->input('date', array('type' => 'text','class' => "form-control datepicker")); ?>	
		</div>
	</div>

	<div class="form-group">

		<h3>Time</h3>
		<div class="form-input">		
			<?php echo $this->Form->input('time', array('type' => 'text','id' => 'time','class' => "form-control")); ?>	
		</div>
	</div>

	<!-- Submit Button -->	
	<div class="form-group">
		<div class="submit-button">
			<?php echo $this->Form->button('Add',array('type' => 'submit','class' => "btn btn-default")); ?>
		</div>
	</div>

	<?php echo $this->Form->end(); ?> 

	<?php //echo $this->element('sql_dump'); ?>

</section>
