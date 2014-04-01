<?php


class Reminder extends AppModel
{
    public $belongsTo = 'User';
    public $validate = array(
        'title' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 30),
                'message' => 'Title can only have a maximum of 30 characters'
            )
        ),
        'body' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Title can only have a maximum of 100 characters'
            )
        ),
        'datetime' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'You must supply a date'
            )
        )
    );

    /**
     * @param $id
     * @param $type        http://book.cakephp.org/2.0/en/models/retrieving-your-data.html
     * @return array
     */
    public function getReminders($id, $type)
    {
        $reminders = $this->find(
            $type,
            array(
                'conditions' => array('user_id' => $id),
                'fields' => array('id', 'title', 'body', 'date', 'time')
            )
        );

        return $reminders;
    }
}

?>