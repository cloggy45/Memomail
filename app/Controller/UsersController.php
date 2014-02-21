<?php 

App::uses('AppController','Controller');

class UsersController extends AppController {
	public $helpers = array('Html', 'Form','TimeZone');
	public $components = array('Session','Auth');
    

	public function beforeFilter() {
		
		$this->Auth->allow('*');
		$this->Auth->loginAction = array('controller' => 'Users',
			'action' => 'login');	

		$this->set('password',$this->Auth->password($this->data['User']['password']));
		$this->Auth->allow();

	}

	public function login() {

		$this->set('cssIncludes',array(''));

		if($this->request->is('post')) {

			if($this->Auth->login()) {
				$this->Session->write('User.username', $this->request->data['User']['username']);
				
				$options = array('fields' => array('User.id',), 'conditions' => array(
						'username' => $this->request->data['User']['username']
					),
				);

				$temp = $this->User->find('first',$options);
	
				$this->Session->write('User.userId',$temp['User']['id']);

				$this->redirect(array('controller' => 'Reminder','action' => 'get'));

			} else {
				$this->Session->setFlash("Incorrect login information");
				
			}
		
				
		}
	}	

	public function logout() {

		$this->Session->delete('User');
		return $this->redirect($this->Auth->logout());

	}


	public function settings() {

		// Todo: Display stacked validation errors
		// Todo: Display 'Settings more than 1 setting be changed'
		$this->set('jsIncludes',array('formValidation'));

		if($this->request->is('post')) {

			//var_dump($this->request->data);

			$SettingsChanged = false;

			$this->User->id = $this->Session->read('Auth.User.id');

			if($this->request->data['User']['Clear All']) {

				$this->User->Reminder->deleteAll(array('Reminder.user_id' => $this->Session->read('Auth.User.id'),false));
			
			} 

			if(!empty($this->request->data['User']['email'])) {

				$this->User->confirm_email = $this->request->data['User']['confirm_email'];
				
				if($this->User->saveField('email', $this->request->data['User']['email'],true)) {
					$SettingsChanged = true;
				}
		
			}

			// Change existing password
			if(!empty($this->request->data['User']['password'])) {

				$this->User->confirm_password = $this->request->data['User']['confirm_password'];

				if($this->User->saveField('password', $this->request->data['User']['password'],true)) {
					$SettingsChanged = true;
				}
				
			}


			if($this->request->data['User']['timezone'] < 99) {
				if($this->User->saveField('timezone', $this->request->data['User']['timezone'],true)) {
					$SettingsChanged = true;
				}
			} 

			if($SettingsChanged) {
				$this->Session->setFlash('Settings Changed');
			}
		}
	}

	public function register() {

		
		$this->set('jsIncludes',array('formValidation','user-views/register'));
	

		if($this->request->is('post')) {
	
			$this->User->save($this->request->data);

			$this->Session->setFlash("User Successfully Registered!");
			
			return $this->redirect(array('controller' => 'Users','action' => 'login'));
		}
	}
}

?>