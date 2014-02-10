<section id="login_view">
	
	<?php echo $this->Session->flash('auth'); ?>
	

	<?php echo $this->Form->create('User',array('type' => 'post','action' => 'login','inputDefaults' => array('label' => false,'div' => false),'class' => "form-horizontal",'role' => "form"
	)); ?>

	<!-- Username -->
	<div class="form-group">
		
		<label class="col-xs-12 col-sm-offset-3 col-sm-2 control-label">Username</label>

		<div class="col-sm-4 col-md-3 col-lg-2">
			<?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Username',
				'class' => 'col-xs-12 col-sm-4 form-control'
				)); ?>
		</div>
	</div>
	

	<!-- Password -->
	<div class="form-group">
		
		<label class="col-xs-12 col-sm-offset-3 col-sm-2 control-label">Password</label>
		
		<div class="col-sm-offset-0 col-sm-4 col-md-3 col-lg-2">
			<?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password',
				'class' => 'col-xs-12 col-sm-4 form-control'
				)); ?>
		</div>
	</div>
	
	<!-- Button -->
	<div class="form-group">
		<div class="col-xs-12 col-sm-offset-5 ">
			<?php echo $this->Form->input('Login',array('type' => 'submit','class' => 'btn btn-default')); ?>
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

