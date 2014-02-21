
<?php App::uses('CakeTime','Utility'); ?>

<div id="get_view">
	<ul class="list-unstyled">
		
	<?php foreach ($reminders as $reminder): ?>
		<li> 	
			<?php echo $this->element('getViewDataContainer',array(
				'id' => $reminder['Reminder']['id'],
				'title' => $reminder['Reminder']['title'],
				'body' => $reminder['Reminder']['body'],
				'time' => $reminder['Reminder']['time'],
				'date' => $reminder['Reminder']['date'],
			)); ?>

		</li>
		

		<?php echo $this->element('modalDialog',array(
			'id' => $reminder['Reminder']['id'],
			'modalBodyContent' => $reminder['Reminder']['body']
			)); ?>

	<?php endforeach; ?>

	<?php unset($post); ?>

	</ul>

</div>

