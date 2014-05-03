<?php

App::uses('AppController','Controller');

class SupportController extends AppController
{
    public $helpers = array('Html', 'Form');
    public $name = 'Support';

    public function submitForm()
    {
        if($this->request->is('post'))
        {
            $data = array(
                'user_id' => $this->Session->read('User.userId'),
                'subject' => $this->request->data['Support']['subject'],
                'category' => $this->request->data['Support']['category'],
                'body' => $this->request->data['Support']['body']
            );

            if($this->Support->save($data))
            {
                $this->Session->setFlash('Support Ticket Submitted');
                $this->redirect(array('controller' => 'Support', 'action' => 'submitForm'));
            }
        }
    }
}