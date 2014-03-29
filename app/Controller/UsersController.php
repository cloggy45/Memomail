<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
    public $helpers = array('Html', 'Form', 'Timezone.Timezone');
    public $components = array('Session', 'Auth', 'Email');

    public function beforeFilter()
    {

        $this->Auth->allow('*');
        $this->Auth->loginAction = array(
            'controller' => 'Users',
            'action' => 'login'
        );

        $this->set('password', $this->Auth->password($this->data['User']['password']));
        $this->Auth->allow();

    }

    public function login()
    {

        if ($this->request->is('post')) {

            if ($this->Auth->login()) {

                $this->Session->write('User.username', $this->request->data['User']['username']);

                $userId = $this->User->getUserId($this->request->data['User']['username']);

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

                $this->User->confirm_email = $this->request->data['User']['confirm_email'];

                if ($this->User->saveField('email', $this->request->data['User']['email'], true)) {
                    $SettingsChanged = true;
                }

            }

            // Change existing password
            if (!empty($this->request->data['User']['password'])) {

                $this->User->confirm_password = $this->request->data['User']['confirm_password'];

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

        $this->User->Registration->deleteAll(array('user_id' => $id),false);
        $this->User->Reminder->deleteAll(array('user_id' => $id),false);

        $this->Session->delete('User');

        $this->redirect(
            array(
                'controller' => 'Users',
                'action' => 'login'
            )
        );
    }

    public function activateAccount()
    {
        $hash = $this->request->params['named']['hash'];

        $isHashValid = $this->User->Registration->getRegHashValidStatus($hash);

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

        $this->Email->smtpOptions = $userAuth;
        $this->Email->delivery = 'smtp';
        $this->Email->from = $fromEmail;
        $this->Email->to = $this->User->getUserDetails($id, 'email');

        $this->set('username', $this->User->getUserDetails($id, 'username'));
        $this->set('hash', $this->User->Registration->getEmailHash($id));

        $this->Email->subject = 'Please Activate Email';
        $this->Email->template = 'registration_activation';
        $this->Email->sendAs = 'both';
        $this->Email->send();

        $this->Session->setFlash('Activation email sent');

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

                $saveHashedEmail = $this->User->Registration->saveEmailHash(
                    $this->User->id,
                    $this->request->data['User']['email']
                );

                if (!$saveHashedEmail) {
                    CakeLog::write('Error', 'UsersController: Unable to save hashed email');
                }

                $this->redirect(
                    array(
                        'controller' => 'Users',
                        'action' => 'sendActivationEmail',
                        'id' => $this->User->id
                    )
                );
            }
        }
    }
}


?>