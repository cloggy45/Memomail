<section id="add_view">

	<?php echo $this->Form->create('Reminder',array('type' => 'post')); ?>

	<?php echo $this->Form->input('title', array('type' => 'text','label' => 'Title')); ?>
	<p id="remainingTitleChars"></p>


	<?php echo $this->Form->input('body', array('type' => 'textarea','label' => 'Body', 'rows' => '5')); ?>
	<p id="remainingBodyChars"></p>

	<?php echo $this->Form->input('datetime', array('type' => 'text', 'label' => 'Date-Time','id' => 'datetime')); ?>	

	<?php echo $this->Form->end('Add'); ?> 

	<?php //echo $this->element('sql_dump'); ?>

</section>
