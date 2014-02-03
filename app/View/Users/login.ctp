<section id="login" class="one-edge-shadow">
	
	<?php echo $this->Session->flash('auth'); ?>
	
	<?php echo $this->Form->create('User',array('type' => 'post','action' => 'login')); ?>

	<?php echo $this->Form->input('username', array('label'=> false,'type' => 'text', 'placeholder' => 'Username')); ?>

	<?php echo $this->Form->input('password', array('label' => false,'type' => 'password', 'placeholder' => 'Password')); ?>

	<?php echo $this->Form->end('Login'); ?>
	

</section>