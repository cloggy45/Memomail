<?php

class Support extends AppModel
{
    public $belongsTo = 'User';

    public $validate = array(
        'subject' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 50),
                'message' => 'Subject can only have a maximum of 30 characters'
            )
        ),
        'body' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field cannot be left blank'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 300),
                'message' => 'Body can only have a maxmimum of 100 characters'
            )
        )
    );

}