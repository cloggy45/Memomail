<?php

class ReminderController extends AppController {
	public $helpers = array('Html', 'Form');
	public $name = 'Reminder';

	public function add() {

		$this->set('cssIncludes',array('themes/default','themes/default.date','themes/default.time'));
		$this->set('jsIncludes',array('reminder-views/add','libs/lib/picker','libs/lib/picker.date','libs/lib/picker.time','libs/lib/legacy'));

		

		if($this->request->is('post')) {	

			$this->Reminder->set($this->request->data);

			if($this->Reminder->validates()) {

				App::uses('CakeTime','Utility');

				// Construct our own $data to include the users Id.
				$data = array('user_id' => $this->Session->read('User.userId'),
					'title' => $this->request->data['Reminder']['title'],
					'body' => $this->request->data['Reminder']['body'],
					'date' => $this->request->data['formatted_date_input_submit'],
					'time' => $this->request->data['formatted_time_input_submit']);

				// Add  'utc_offset' => $timezone);

				$this->Reminder->save($data);

				//$this->flash("Reminder Added","Reminder/add");

				return $this->redirect(array('controller' => 'Reminder', 'action' => 'get'));
			
			} else  {

				$errors = $this->Reminder->validationErrors;
				// return $this->redirect(array('controller' => 'Reminder', 'action' => 'add'));
			}
		}
	}

	public function get() {

		$options = array(
			'fields' => array(
				'Reminder.id',
				'Reminder.title',
				'Reminder.body',
				'Reminder.date',
				'Reminder.time'
				),
			'conditions' => array(
				'user_id' => $this->Session->read('User.userId'),
				),
			);	

		if(!$this->Reminder->find('all',$options))  {
		
			$this->set('cssIncludes',array(''));
			$this->render('no_reminders'); 
		
		} else {

			// $this->set('cssIncludes',array('reminder-views/get_style.css','jquery-ui-style'));
			$this->set('jsIncludes',array('reminder-views/get'));

			$this->set('reminders', $this->Reminder->find('all',$options));
		}
	}

	public function displayMoreBodyInformation() {
		 // TODO
	}

	public function modify() {
		// TODO
	}

	public function delete() {

		$this->Reminder->delete($this->params['url']['id']);
		return $this->redirect(array('controller' => 'Reminder','action' => 'get'));
	}

}


?>