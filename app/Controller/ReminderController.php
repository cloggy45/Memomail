<?php

class ReminderController extends AppController {
	public $helpers = array('Html', 'Form');
	public $name = 'Reminder';

	public function add() {

		$this->set('cssIncludes',array('layout_styles/reminder-view-styles/jquery-ui-style'));

		$this->set('jsIncludes',array('reminder-views/add','libs/jquery-ui','libs/jquery_timepicker'));

		if($this->request->is('post')) {	

			$this->Reminder->set($this->request->data);

	
			if($this->Reminder->validates()) {

				echo "Inside validate";

				App::uses('CakeTime','Utility');

				$temp = explode(" ", $this->request->data['Reminder']['datetime']);
				
				// Reverses the orignal date d/m/y
				$date = CakeTime::format($temp[0],'%Y-%m-%d');

				// From 12 hour time to 24 hour
				$time = date("H:i",strtotime($temp[1] . " " . $temp[2]));

				// Create final string
				$datetime = $date . " " . $time;

				// Create UTC offset string
				$timezone = $temp[3];
				
				// Construct our own $data to include the users Id.
				$data = array('user_id' => $this->Session->read('User.userId'),
					'title' => $this->request->data['Reminder']['title'],
					'body' => $this->request->data['Reminder']['body'],
					'datetime' => $datetime,
					'time' => $time,
					'utc_offset' => $timezone);

				$this->Reminder->save($data);

				$this->flash("Reminder Added","Reminder/add",5);

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
				'Reminder.datetime',
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

			$this->set('cssIncludes',array('reminder-views/get_style.css','jquery-ui-style'));
			$this->set('jsIncludes',array('reminder-views/get','jquery-ui'));

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