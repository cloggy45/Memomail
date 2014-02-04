<?php 

class UsersController extends AppController {
	public $helpers = array('Html', 'Form');
	public $components = array('Session','Auth','Recaptcha.Recaptcha');
    

	public function beforeFilter() {
		$this->Auth->loginAction = array('controller' => 'Users',
			'action' => 'login');	

		$this->set('password',$this->Auth->password($this->data['User']['password']));
		$this->Auth->allow();
		
	}

	public function login() {

		$this->set('cssIncludes',array('user-views/login_style'));

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
		$this->set('cssIncludes', array('user-views/settings_style'));

		if($this->request->is('post')) {

			$this->User->set($this->request->data);

			var_dump($this->request->data);

			if($this->request->data['User']['email'] !== $this->request->data['User']['Re-enter_new_email']) {
					$this->Session->setFlash("New emails don't match");
				}

			if($this->User->validates(array('fieldList' => array('email')))) {

				if($this->request->data['User']['email'] !== $this->request->data['User']['Re-enter_new_email']) {
					$this->Session->setFlash("New emails don't match");
					return;
				}	
			} 

			elseif($this->User->validates(array('fieldList' => array('password')))) {

				if($this->request->data['User']['password'] !== $this->request->data['User']['re-enter_new_password']) {
					$this->Session->setFlash("New passwords don't match");
				}

			} else {
				$this->Session->setFlash("Nothing changed");
			}
		}
	}

	public function register() {

		$this->set('cssIncludes',array('user-views/register_style'));
		
		if($this->request->is('post')) {

			if($this->Recaptcha->verify()) {

				if($this->request->data['User']['email'] !== $this->request->data['User']['reenter-email']) {
					
					$this->Session->setFlash("Email addresss entered do not match");

				} elseif($this->request->data['User']['password'] !== $this->request->data['User']['reenter-password']) {

					$this->Session->setFlash("Entered passwords do not match");

				} else { 

					$this->User->set($this->request->data);

					if($this->User->validates()) {

						echo "Validated";
						$this->User->save($this->request->data);

						$this->Session->setFlash("User Successfully Registered!");
						
						return $this->redirect(array('controller' => 'Users','action' => 'login'));

					} else {

						$errors = $this->User->invalidFields();
						
					}
				}

			} else 
				$this->Session->setFlash($this->Recaptcha->error);
		}
	}
}

?>