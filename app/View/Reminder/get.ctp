
<?php App::uses('CakeTime','Utility'); ?>

<div id="get_view">
	<ul>
		
	<?php foreach ($reminders as $reminder): ?>
		<li class="one-edge-shadow"> 
					
			<div id="edit-options">
				<?php // echo $this->Html->link('Modify', array('controller' => 'Reminder','action' => 'modify','?' => array('id' => $reminder['Reminder']['id']))); ?>

				<?php echo $this->Html->link('Delete', array('controller' => 'Reminder','action' => 'delete','?' => array('id' => $reminder['Reminder']['id']))); ?>
			</div>
	
			<h2><?php echo $reminder['Reminder']['title']; ?> </h2>

			<?php if(strlen($reminder['Reminder']['body']) > 40): ?>
				
				<?php $stringDisplay = substr($reminder['Reminder']['body'], 0,35); ?>
				
				<p> <?php echo $stringDisplay . "..."; ?> </p>

				<p id="moreBody"> <?php //echo $this->Html->link('More', array('?' => array('id' => $reminder['Reminder']['id'])),array('data-toggle' => 'modal','data-target' => '#myModal')); ?>
				
				<?php echo "
				<button id='btn' class='btn btn-primary btn-sm' data-toggle='modal' data-id=" . $reminder['Reminder']['id'] . " data-target='#myModal" . $reminder['Reminder']['id'] . "'>More</button>";
 
				
				?>
				</p>

			<?php else: ?>
				
				<p><?php echo $reminder['Reminder']['body']; ?> </p>

			<?php endif; ?>

			<p id="time"><?php echo $reminder['Reminder']['time']; ?></p>
			<p id="date"><?php echo $date = CakeTime::format($reminder['Reminder']['date'],'%d-%m-%y'); ?> </p>

		</li>
		
		<!-- Bootstrap 3 Modal Dialog Box -->
		<?php echo '<div class="modal fade" id="myModal' . $reminder['Reminder']['id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'; ?>
			<div class="modal-dialog">
			    <div class="modal-content">

			    	<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        	<h4 class="modal-title" id="myModalLabel">More</h4>
			        </div>

			      	<div class="modal-body"> 
			      		<p><?php echo $reminder['Reminder']['body']; ?></p>
			      		
			        
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			      	</div>
			    </div>
			</div>
		</div>

	<?php endforeach; ?>

	<?php unset($post); ?>

	</ul>

	<?php //echo $this->element('sql_dump'); ?>
</div>

