
<?php App::uses('CakeTime','Utility'); ?>

<div id="get_view">
	<ul>
		
	<?php foreach ($reminders as $reminder): ?>
		<li class="one-edge-shadow"> 
					
			<div id="edit-options">
				<?php echo $this->Html->link('Modify', array('controller' => 'Reminder','action' => 'modify','?' => array('id' => $reminder['Reminder']['id']))); ?>

				<?php echo $this->Html->link('Delete', array('controller' => 'Reminder','action' => 'delete','?' => array('id' => $reminder['Reminder']['id']))); ?>
			</div>
	
			<h2><?php echo $reminder['Reminder']['title']; ?> </h2>

			<?php if(strlen($reminder['Reminder']['body']) > 40): ?>
				
				<?php $stringDisplay = substr($reminder['Reminder']['body'], 0,35); ?>
				
				<p> <?php echo $stringDisplay . "..."; ?> </p>

				<p id="moreBody"> <?php echo $this->Html->link('More', array('controller' => 'Reminder','action' => 'displayMoreBodyInformation','?' => array('id' => $reminder['Reminder']['id']))); ?>
				</p>

				
			
			<?php else: ?>
				
				<p><?php echo $reminder['Reminder']['body']; ?> </p>

			<?php endif; ?>


			<p id="time"><?php echo $reminder['Reminder']['time']; ?></p>
			<p id="date"><?php echo $date = CakeTime::format($reminder['Reminder']['datetime'],'%d-%m-%y'); ?> </p>

		</li>

	<?php endforeach; ?>

	<?php unset($post); ?>

	</ul>

	<?php //echo $this->element('sql_dump'); ?>
</div>

