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
		<?php echo $this->Form->input('password', array(
			'type' => 'password',
			'class' => 'form-control',
			'placeholder' => 'Password',
			'data-validation' => 'length strength',
			'data-validation-length' => '5-10',
			'data-validation-strength' => '2',
			'data-validation-optional' => 'true'
		)); ?>
		</div>
	</div>
	
	<!-- Re-enter Password -->
	<div class="form-group">
		<!-- <label class="control-label">Re-enter Password</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('confirm_password', array(
			'type' => 'password',
			'class' => 'form-control',
			'placeholder' => 'Re-enter Password',
			'data-validation' => 'original_password'
		)); ?>
		</div>
	</div>
	
	<!-- Email -->
	<div class="form-group">
		<!-- <label class="control-label">Email</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('email',array(
			'type' => 'email',
			'class' => 'form-control',
			'placeholder' => 'Email'
		)); ?>
		</div>
	</div>

	<!-- Re-enter Email -->
	<div class="form-group">
		<!-- <label class="control-label">Re-enter Email</label> -->
		<div class="form-input">
		<?php echo $this->Form->input('confirm_email',array(
			'type' => 'email',
			'class' => 'form-control',
			'placeholder' => 'Re-enter Email',
			'data-validation' => "email original_email",
		)); ?>
		</div>
	</div>
	
	<!-- Enter Timezone -->	
	<div class="form-group">
		<!-- <label class="control-label">Enter Timezone</label> -->
		<div class="form-input">
                    <?php echo $this->Timezone->select('timezone',NULL,array('class' => 'form-control')); ?>
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