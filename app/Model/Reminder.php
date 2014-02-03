<?php 

class Reminder extends AppModel {
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank'
				),
			'maxLength' => array(
				'rule' => array('maxLength',25),
				'message' => 'Title can only have a maximum of 25 characters' 
				)
			),
		'body' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This field cannot be left blank'
				),
			'maxLength' => array(
				'rule' => array('maxLength',100),
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
}

?>