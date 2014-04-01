<?php

class ReminderFixture extends CakeTestFixture
{
    public $import = array('model' => 'Reminder');

    public $records = array(
        array(
            'id' => 1,
            'user_id' => 1,
            'title' => 'Some Event Title',
            'body' => 'Some Event Body',
            'date' => '2014-03-31',
            'time' => '00:50:00',
            'timestamp' => '1396323300'
        ),
        array(
            'id' => 2,
            'user_id' => 1,
            'title' => 'Some Event Title',
            'body' => 'Some Event Body',
            'date' => '2014-03-31',
            'time' => '00:29:00',
            'timestamp' => '1395496400'
        ),
        array(
            'id' => 3,
            'user_id' => 1,
            'title' => 'Some Event Title',
            'body' => 'Some Event Body',
            'date' => '2014-03-31',
            'time' => '00:10:00',
            'timestamp' => '1395496423'
        )
    );
}