<section id="settings_view">
	
	<h1>Settings</h1>

	<?php echo $this->Form->create('User', array('type' => 'post','inputDefaults' => array('label' => false,
		'div' => false),'class' => 'form-horizontal','role' => "form")); ?>
	

	
	<!-- Enter Email -->
	<div class="form-group">

		<h3>Change Email</h3>

		<div class="form-input">
		<?php echo $this->Form->input('email', array('type' => 'email','required' => false,'placeholder' => 'New Email','class' => 'form-control')); ?>
		</div>
	</div>

	<!-- Re-enter Email -->
	<div class="form-group">

		<div class="form-input">
		<?php echo $this->Form->input('confirm_email', array('type' => 'email',
			'required' => false,
			'placeholder' => 'Re-enter New Email','class' => 'form-control'
			)); ?>
		</div>
	</div>

	<!-- Enter Password -->
	<div class="form-group">

		<h3>Change Password</h3>

		<div class="form-input">
		<?php echo $this->Form->input('password', array('type' => 'password','required' => false,'placeholder' => 'New Password','class' => 'form-control','value' => "")); ?>
		</div>		
	</div>

	<!-- Re-enter Password -->
	<div class="form-group">

		<div class="form-input">
		<?php echo $this->Form->input('re-enter_new_password', array('type' => 'password','placeholder' => 'Re-enter New Password','class' => 'form-control')); ?>	
		</div>				
	</div>
	
	<!-- Change Timezone -->
	<div class="form-group">
		<h3>Change Timezone</h3>
		<div class="form-input">
		<?php echo $this->TimeZone->select('timezone',array('class' => 'form-control')); ?>
		</div>				
	</div>
	

	<!-- Clear Reminders -->
	<div class="form-group">
		<h3>Clear Reminders</h3>
		
		<div class="checkbox">
			<label class="control-form"><?php echo $this->Form->checkbox('Clear All') ?>Clear all reminders</label>
		</div>
	</div>
	
	<!-- Apply Button -->
	<div class="form-group">
		<div class="submit-button">
		<?php echo $this->Form->button('Apply',array('type' => 'submit','class' => 'btn btn-default')); ?>
		</div>
	</div>

	<?php echo $this->end(); ?>

	<?php // echo $this->element('sql_dump'); ?>

<!--

Change Password
Change Email

 -->

</section>