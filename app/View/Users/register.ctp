<section id="register" class="one-edge-shadow">

	<?php echo $this->Form->create('User',array('type' => 'post')); ?>
	
	<?php echo $this->Form->input('username', array('type' => 'text', 'label' => 'Desired Username')); ?>
	
	<?php echo $this->Form->input('password', array('type' => 'password', 'label' => 'Password')); ?>
	<?php echo $this->Form->input('reenter-password', array('type' => 'password', 'label' => 'Re-enter Password')); ?>

	<?php echo $this->Form->input('email', array('type' => 'email', 'label' => 'Email')); ?>
	<?php echo $this->Form->input('User.reenter-email', array('type' => 'email', 'label' => 'Re-enter Email')); ?>

	<?php echo $this->Recaptcha->display(array('recaptchaOptions' => array('theme' => 'red'))); ?>
	
	<?php echo $this->Form->end('Register'); ?>

</section>