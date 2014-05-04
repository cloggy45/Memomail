<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $helpers = array('Html', 'Form', 'Timezone.Timezone');
    public $components = array('Session', 'Auth', 'Email');


    private $address = "http://192.168.0.11/Remind-Me";

    public function beforeFilter()
    {
        $this->Auth->allow('*');

        $this->Auth->loginAction = array(
            'controller' => 'Users',
            'action' => 'login'
        );

        if(array_key_exists('password',$this->data)) {
            $this->set('password', $this->Auth->password($this->data['User']['password']));
        }
        $this->Auth->allow();
    }

    public function login()
    {

        if ($this->request->is('post')) {

            if ($this->Auth->login()) {

                $this->Session->write('User.username', $this->request->data['User']['username']);

                $fieldValue = $this->request->data['User']['username'];

                $userId = $this->User->getUserId('username', $fieldValue);

                $this->Session->write('User.userId', $userId);

                $registrationValid = $this->User->Registration->getRegValidStatus($userId);

                if (!$registrationValid) {

                    $this->Session->setFlash('Activate Email First');
                    $this->Session->delete('User');

                    return $this->redirect($this->Auth->logout());

                } else {
                    $this->redirect(array('controller' => 'Reminder', 'action' => 'get'));
                }

            } else {
                $this->Session->setFlash("Incorrect login information");
            }
        }
    }

    public function logout()
    {

        $this->Session->delete('User');

        $this->redirect($this->Auth->logout());
    }

    public function settings()
    {

        // Todo: Display stacked validation errors
        // Todo: Add fade to setFlash messages

        $this->set('jsIncludes', array('formValidation'));

        if ($this->request->is('post')) {

            $SettingsChanged = false;

            $this->User->id = $this->Session->read('Auth.User.id');

            if ($this->request->data['User']['Clear All']) {

                $this->User->Reminder->deleteAll(
                    array('Reminder.user_id' => $this->Session->read('Auth.User.id'), false)
                );
            }

            if (!empty($this->request->data['User']['email'])) {

                $this->User->setConfirmEmail($this->request->data['User']['confirm_email']);

                if ($this->User->saveField('email', $this->request->data['User']['email'], true)) {
                    $SettingsChanged = true;
                }
            }

            if (!empty($this->request->data['User']['password'])) {

                $this->User->setConfirmPassword($this->request->data['User']['confirm_password']);

                if ($this->User->saveField('password', $this->request->data['User']['password'], true)) {
                    $SettingsChanged = true;
                }
            }

            if ($this->request->data['User']['timezone'] < 99) {
                if ($this->User->saveField('timezone', $this->request->data['User']['timezone'], true)) {
                    $SettingsChanged = true;
                }
            }

            if ($this->request->data['User']['Clear All']) {
                $SettingsChanged = true;
                $this->Session->setFlash('Cleared all reminders');
            }

            if ($SettingsChanged) {
                $this->Session->setFlash('Settings Changed');

            } else {
                $this->Session->setFlash('Nothing Changed');
            }
        }
    }

    public function deleteAccount()
    {
        $id = $this->Session->read('User.userId');

        $this->User->delete($id);

        $this->User->Registration->deleteAll(array('user_id' => $id), false);
        $this->User->Reminder->deleteAll(array('user_id' => $id), false);

        $this->Session->delete('User');

        $this->redirect(
            array(
                'controller' => 'Users',
                'action' => 'login'
            )
        );
    }

    public function resetPassword()
    {
        if(count($this->request->params['named']) == 1) {

            $tempHash = $this->request->params['named']['hash'];

            $this->Session->write('Config.id', $this->User->getUserId('email_hash',$tempHash));
            $this->Session->write('Config.hash', $tempHash);

            $tempId = $this->Session->read('Config.id');

            if(empty($tempId)) {
                $this->Session->destroy();
                $this->Session->setFlash("Link is old");
                $this->redirect('login');
            }
        };

        if ($this->request->is('post')) {

            $id = $this->Session->read('Config.id');

            $this->User->id = $id;

            $this->User->setConfirmPassword($this->request->data['User']['confirm_password']);

            if($this->User->saveField('password', $this->request->data['User']['password'],true)) {

                $this->Session->setFlash('Password changed');

                $email = $this->User->getUserDetails($id,'email');
                $email += $this->Session->read('Config.time');

                $this->User->saveEmailHash($id,$email);

                $this->redirect('login');
            }
        }
    }

    public function sendResetEmail()
    {
        if ($this->request->is('post')) {

            $email = $this->request->data['User']['resetEmail'];

            $emailExists = $this->User->checkValueExists('email',$email);

            $id = $this->User->getUserId('email', $email);

            if ($emailExists && !$this->User->Registration->getRegValidStatus($id)) {

                $this->Session->setFlash("You must activate account before changing passwords");

            } elseif ($emailExists) {

                $this->redirect(
                    array(
                        'controller' => 'Users',
                        'action' => 'sendActivationEmail',
                        'type' => 'reset',
                        'id' => $id
                    )
                );

            } else {
                $this->Session->setFlash("Account does not exist");
            }

        }
    }

    public function activateAccount()
    {
        $hash = $this->request->params['named']['hash'];

        $isHashValid = $this->User->Registration->setRegIsValidStatus($hash);

        if ($isHashValid) {
            $this->Session->setFlash('Account Validated');

            $this->redirect(
                array(
                    'controller' => 'Users',
                    'action' => 'login'
                )
            );

        } else {
            $this->Session->setFlash('Account not valid');
        }
    }

    public function sendActivationEmail()
    {
        require_once APP . 'Config/SendGridAuth.php';

        $id = $this->request->params['named']['id'];
        $emailType = $this->request->params['named']['type'];

        $this->Email->smtpOptions = $sendAuth;
        $this->Email->delivery = 'smtp';
        $this->Email->from = $fromEmail;
        $this->Email->to = $this->User->getUserDetails($id, 'email');

        $this->set('username', $this->User->getUserDetails($id, 'username'));

        if ($emailType == "activation") {

            $this->set('hash', $this->User->Registration->getEmailHash($id));
            $this->set('address', $this->address . '/Users/activateAccount/hash:');

            $this->Email->subject = 'Please Activate Email';
            $this->Email->template = 'registration_activation';
            $this->Email->sendAs = 'both';
            $this->Email->send();

            $this->Session->setFlash('Activation email sent');

        } elseif ($emailType == "reset") {

            $this->set('hash', $this->User->getEmailHash($id));
            $this->set('address', $this->address . '/Users/resetPassword/hash:');

            $this->Email->subject = 'Reset Password';
            $this->Email->template = 'password_reset';
            $this->Email->sendAs = 'both';
            $this->Email->send();

            $this->Session->setFlash('Reset instructions sent');
        }

        $this->redirect(
            array(
                'controller' => 'Users',
                'action' => 'login',
            )
        );
    }

    public function register()
    {

        $this->set('jsIncludes', array('formValidation', 'user-views/register'));

        if ($this->request->is('post')) {

            if ($this->User->save($this->request->data)) {

                $id = $this->User->id;
                $email = $this->request->data['User']['email'];
                $time = $this->Session->read('Config.time');

                $email += $time;

                $saveHashedEmail = $this->User->Registration->saveEmailAsHash($id, $email);

                if (!$saveHashedEmail) {
                    CakeLog::write('Error', 'UsersController: Unable to save hashed email');
                }

                $this->User->saveEmailHash($id, $email);

                $this->redirect(
                    array(
                        'controller' => 'Users',
                        'action' => 'sendActivationEmail',
                        'type' => "activation",
                        'id' => $this->User->id
                    )
                );
            }
        }
    }
}


?>