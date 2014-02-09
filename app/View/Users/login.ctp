<section id="login_view" class="ag ag4">
	
	<?php echo $this->Session->flash('auth'); ?>
	
	<?php echo $this->Form->create('User',array('type' => 'post','action' => 'login','class' => 'form-horizontal')); ?>

	<?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Username','div' => array('class' => 'control-group'),'label' => array('class' => 'control-label'))); ?>

	<?php echo $this->Form->input('password', array('type' => 'password', 'placeholder' => 'Password','div' => array('class' => 'control-group'),'label' => array('class' => 'control-label'))); ?>
	
	<?php $options = array('label' => 'Login','div' => array('class' => 'controls')); ?>

	<?php echo $this->Form->end($options); ?>
	

</section>