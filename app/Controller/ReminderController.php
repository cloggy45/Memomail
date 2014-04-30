<?php

class ReminderController extends AppController
{
    public $helpers = array('Html', 'Form');
    public $name = 'Reminder';

    public function add()
    {
        $this->set('cssIncludes', array('themes/default', 'themes/default.date', 'themes/default.time'));
        $this->set(
            'jsIncludes',
            array(
                'reminder-views/add',
                'libs/lib/picker',
                'libs/lib/picker.date',
                'libs/lib/picker.time',
                'libs/lib/legacy'
            )
        );

        if ($this->request->is('post')) {

            $this->Reminder->set($this->request->data);

            if ($this->Reminder->validates()) {

                App::uses('CakeTime', 'Utility');

                $userTimezone = $this->Reminder->User->getUserDetails($this->Session->read('User.userId'), 'timezone');

                $tempString = $this->request->data['formatted_date_input_submit'] . " " .
                    $this->request->data['formatted_time_input_submit'] . " " .
                    $userTimezone;

                // Using preceding $userTimezone, generate unix timestamp ready to be saved
                $unixTimestamp = strtotime($tempString);

                // Construct our own $data to include the users Id.
                $data = array(
                    'user_id' => $this->Session->read('User.userId'),
                    'title' => $this->request->data['Reminder']['title'],
                    'body' => $this->request->data['Reminder']['body'],
                    'date' => $this->request->data['formatted_date_input_submit'],
                    'time' => $this->request->data['formatted_time_input_submit'],
                    'timestamp' => $unixTimestamp
                );

                $this->Reminder->save($data);

                $this->flash("Reminder Added", "Reminder/add");

                $this->redirect(array('controller' => 'Reminder', 'action' => 'get'));

            } else {

                echo $this->Reminder->validationErrors;
                $this->redirect(array('controller' => 'Reminder', 'action' => 'add'));
            }
        }
    }

    public function get()
    {

        $id = $this->Session->read('User.userId');

        $usersReminders = $this->Reminder->getReminders($id, 'all');

        if (!$usersReminders) {

            $this->render('no_reminders');

        } else {

            $this->set('jsIncludes', array('reminder-views/get'));

            $this->set('reminders', $usersReminders);
        }
    }


    public function delete()
    {
        $this->Reminder->delete($this->params['url']['id']);
        $this->redirect(array('controller' => 'Reminder', 'action' => 'get'));
    }

}


?>