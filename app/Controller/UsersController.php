<?php 

App::uses('AppController','Controller');

class UsersController extends AppController {
	public $helpers = array('Html', 'Form','Timezone.Timezone');
	public $components = array('Session','Auth','Email');
  
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
                                
                                //If first time loggin in
                                
                                if($this->User->Registration->find('first',array(
                                    'conditions' => array('Registration.user_id' => $this->Session->read('User.userId')),
                                    'fields' => 'Registration.reg_valid'))) {
                                     
                                    var_dump($this->User->Registration->find('first',array(
                                    'conditions' => array('Registration.user_id' => $this->Session->read('User.userId')),
                                    'fields' => 'Registration.reg_valid')));
     
                                    $this->Session->setFlash('Activate Email First');
                                    
                                } else {
                                    $this->redirect(array('controller' => 'Reminder','action' => 'get'));
                                }
                                
                                //else login normally
				
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
		// Todo: Add fade to setFlash messages
		
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
				
				if($this->User->saveField('email',$this->request->data['User']['email'],true)) {
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

			if($this->request->data['User']['Clear All']) {
				$SettingsChanged = true;
				$this->Session->setFlash('Cleared all reminders');
			}

			if($SettingsChanged) {
				$this->Session->setFlash('Settings Changed');
			} else {
				$this->Session->setFlash('Nothing Changed');
			}
		}
	}
        
        public function sendActivationEmail() 
        {

        	require_once '../app/config/SendGridAuth.php';

            $this->Email->smtpOptions = $userAuth;

            $this->Email->delivery = 'smtp';
            $this->Email->from = 'Paul ';
            $this->Email->to = 'Recipient Name ';
            $this->set('', 'Recipient Name');
            $this->Email->subject = 'This is a subject';
            $this->Email->template = 'registrationActivation';
            $this->Email->sendAs = 'both';
            $this->Email->send();

        }
        
	public function register() {
            
		$this->set('jsIncludes',array('formValidation','user-views/register'));
	
		if($this->request->is('post')) {
                        
			if($this->User->save($this->request->data)) {

				$this->Session->setFlash("Activation email sent!");
                                
                                $email = Security::hash($this->request->data['User']['email'],'sha1',true);
                                
                                $this->User->Registration->save(array(
                                    'user_id' => $this->User->id,
                                    'reg_valid' => 'false',
                                    'hash' => $email
                                    ));
                                
				return $this->redirect(array('controller' => 'Users','action' => 'login'));
			}
		}
	}
}

?>