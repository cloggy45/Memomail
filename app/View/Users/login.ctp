<section id="login_view">
	
	<?php echo $this->Session->flash('auth'); ?>
	
	<?php echo $this->Form->create('User',array('type' => 'post','action' => 'login','inputDefaults' => array('label' => false,'div' => false),'class' => "form-horizontal",'role' => "form"
	)); ?>

	<!-- Username -->
	<div class="form-group">
		
		<!-- <label class="control-label">Username</label> -->

		<div class="form-input">
			<?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Username',
				'class' => 'form-control'
				)); ?>
		</div>
	</div>
	

	<!-- Password -->
	<div class="form-group">
		
		<!-- <label class="control-label">Password</label> -->
		
		<div class="form-input">
			<?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password',
				'class' => 'form-control'
				)); ?>
		</div>
	</div>
	
	<!-- Button -->
	<div class="form-group">
		<div class="submit-button">
			<?php echo $this->Form->button('Login',array('type' => 'submit','class' => 'btn btn-default')); ?>
		</div>
	</div>

	<?php echo $this->Form->end(); ?>
	
</section>

<!---

	Form
		Div
			Label
			Input
		/Div

