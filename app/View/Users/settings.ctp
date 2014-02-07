<section id="settings">
	
	<h1>Settings</h1>

	<?php echo $this->Form->create('User', array('type' => 'post')); ?>
	
	<div id="ChangeEmail">
	
		<h3>Change Email</h3>
		<?php echo $this->Form->input('email', array('type' => 'email','label' => 'New Email','required' => false)); ?>

		<?php echo $this->Form->input('Re-enter_new_email', array('type' => 'email','required' => false)); ?>
	</div>

	<div id="ChangePassword">
		<h3>Change Password</h3>
		
		<?php echo $this->Form->input('password', array('type' => 'password','required' => false,'label' => 'New Password')); ?>

		<?php echo $this->Form->input('re-enter_new_password', array('type' => 'password')); ?>	
	</div>

	<div id="ClearReminders">
		<h3>Clear Reminders</h3>
		<p>Clear all reminders:</p><?php echo $this->Form->checkbox('Clear All') ?>
	</div>

	<?php echo $this->Form->submit('Apply'); ?>
	<?php echo $this->end(); ?>

	<?php // echo $this->element('sql_dump'); ?>

<!--

Change Password
Change Email

 -->

</section>