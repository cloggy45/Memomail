<section id="settings_view">
	
	<h1>Settings</h1>

	<?php echo $this->Form->create('User', array('type' => 'post','inputDefaults' => array('label' => false,
		'div' => false),'class' => 'form-horizontal','role' => "form")); ?>
	

 	<!-- Change Email -->
	<div class="form-group">

		<h3>Change Email</h3>

		<div class="form-input">

		<?php echo $this->Form->input('email', array(
			'type' => 'email',
			'required' => false,
			'placeholder' => 'New Email',
			'class' => 'form-control',
			'value' => "",
			'data-validation-optional' => 'true'
			)); ?>

		</div>
	</div>

	<!-- Re-enter Email -->
	<div class="form-group">

		<div class="form-input">

		<?php echo $this->Form->input('confirm_email', array(
			'type' => 'email',
			'required' => false,
			'placeholder' => 'Re-enter New Email',
			'class' => 'form-control',
			'value' => "",
			'data-validation' => "email original_email",
			'data-validation-optional' => 'true'
			)); ?>
	
		</div>
	</div>

	<!-- Enter Password -->
	<div class="form-group">
		<h3>Change Password</h3>
		<div class="form-input">
		<?php echo $this->Form->input('password', array(
			'type' => 'password',
			'required' => false,
			'placeholder' => 'New Password',
			'class' => 'form-control',
			'value' => "",
			'data-validation' => 'length strength',
			'data-validation-length' => '5-20',
			'data-validation-strength' => '2',
			'data-validation-optional' => 'true'
			)); ?>
		</div>		
	</div>

	<!-- Re-enter Password -->
	<div class="form-group">
		<div class="form-input">
		<?php echo $this->Form->input('confirm_password', array(
			'type' => 'password',
			'placeholder' => 'Re-enter New Password',
			'class' => 'form-control',
			'value' => "",
			'data-validation' => 'original_password'
			)); ?>	
		</div>				
	</div>
	
	<!-- Change Timezone -->
	<div class="form-group">
		<h3>Change Timezone</h3>
		<div class="form-input">
		<?php echo $this->Timezone->select('timezone',NULL,array('class' => 'form-control')); ?>
		</div>				
	</div>
	
	<!-- Delete Account -->
	<div class="form-group">
		<h3>Delete Account</h3>
		<div class="submit-button">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				Are you sure?
			</button>
			<ul class="dropdown-menu" role="menu">
				<li><?php echo $this->Html->link('Delete Account','/users/deleteAccount') ?></li>
			</ul>
		</div>
	</div>

	<!-- Clear Reminders -->
	<div class="form-group">
		<h3>Clear Reminders</h3>
		
		<div class="checkbox">
			<label class="control-form"><?php echo $this->Form->checkbox('Clear All',array('checked' => false)) ?>Clear all reminders</label>
		</div>
	</div>

	
	
	<!-- Apply Button -->
	<div class="form-group">
		<div class="submit-button">
		<?php echo $this->Form->button('Apply Changed Settings',array('type' => 'submit','class' => 'btn btn-default')); ?>
		</div>
	</div>

	<?php echo $this->end(); ?>

	<?php // echo $this->element('sql_dump'); ?>

</section>
