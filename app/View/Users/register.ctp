<section id="register_view">
	
	<h1>Register</h1>

	<?php echo $this->Form->create('User',array('type' => 'post',
		'inputDefaults' => array('label' => false,
		'div' => false),'class' =>'form-horizontal','role' => 'form'
		)); ?>
	
	<!-- Username -->
	<div class="form-group">
<!-- 		<label class="control-label">Username</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('username',array('type' => 'text','class' => "form-control",
			'placeholder' => "Username")); ?>
		</div>
	</div>

	<!-- Password -->
	<div class="form-group">
		<!-- <label class="control-label">Password</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('password', array('type' => 'password',
			'class' => 'form-control',
			'placeholder' => 'Password'
		)); ?>
		</div>
	</div>
	
	<!-- Re-enter Password -->
	<div class="form-group">
		<!-- <label class="control-label">Re-enter Password</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('confirm_password', array('type' => 'password','class' => 'form-control',
			'placeholder' => 'Re-enter Password'
		)); ?>
		</div>
	</div>
	
	<!-- Email -->
	<div class="form-group">
		<!-- <label class="control-label">Email</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('email',array('type' => 'email','class' => 'form-control',
			'placeholder' => 'Email'
		)); ?>
		</div>
	</div>

	<!-- Re-enter Email -->
	<div class="form-group">
		<!-- <label class="control-label">Re-enter Email</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('confirm_email',array('type' => 'email',
			'class' => 'form-control',
			'placeholder' => 'Re-enter Email'
		)); ?>
		</div>
	</div>
	
	<!-- Enter Timezone -->	
	<div class="form-group">
		<!-- <label class="control-label">Enter Timezone</label> -->
		<div class="form-input">
		<?php echo $this->TimeZone->select('User.timezone',array('class' => 'form-control')); ?>
		</div>
	</div>
	


	<div class="form-group">
		<div class="submit-button">
		<?php echo $this->Form->button('Submit', array('type' => 'submit',
			'class' => 'btn btn-default'
		)); ?>
		</div>
	</div>

	<?php echo $this->Form->end(); ?>

</section>