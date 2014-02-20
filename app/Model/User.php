<?php

App::uses('SimplePasswordHasher','Controller/Component/Auth');

class User extends AppModel {
	public $useTable = 'users';

	public $hasMany = array(
		'Reminder' => array(
			'className' => 'Reminder'
			)
		);

	public $validate = array(
			'username' => array(
				'alphaNumeric' => array(
					'rule' => 'alphaNumeric',
					'required' => true,
					'message' => 'Alphabets and numbers only'
					),
				'between' => array(
					'rule' => array('between',5,15),
					'message' => 'Between 5 to 15 characters'
					),
				'unique' => array(
					'rule' => 'isUnique',
					'message' => 'Username is already taken'
					)
				),
			'password' => array(
				'between' => array(
					'rule' => array('between',5,10),
					'message' => 'Between 5 to 10',
					),
				'compareFields' => array(
					'rule' => array('compareFields','confirm_password'),
					'message' => 'Passwords do not match',
					'required' => 'update'
					)
				),	
			'email' => array(
				'email' => array(
					'rule' => 'email',
					'message' => 'Please enter valid email address'
					),
				'unique' => array(
					'rule' => 'isUnique',
					'message' => 'Email is already in use'
					),
				'compareFields' => array(
					'rule' => array('compareFields','confirm_email'),
					'message' => 'Emails do not match',
					'required' => 'update'
					)
				),
			'timezone' => array(
				'isValid' => array(
					'rule' => 'isValid',
					'message' => 'Please select a timezone'
					)
				)
			);


	public function isValid($check) {
		$value = array_values($check);

		if($value[0] == "99") 
			return false;
		else 
			return true;
	}

	public function compareFields($check,$comparedField=null) {
		
		if($fieldOne[0] == $this->data[$this->alias][$comparedField]) 
			return true;
	}

	public function beforeValidate($options = array()) {
		var_dump($options);
	}

	public function beforeSave($options = array()) {
		
		var_dump($this->data[$this->alias]);

		if($this->validates(array('fieldList' => array('password')))) {
		    if (isset($this->data[$this->alias]['password'])) {

		        $passwordHasher = new SimplePasswordHasher();
		        $this->data[$this->alias]['password'] = $passwordHasher->hash(
		            $this->data[$this->alias]['password']
		        );
		    }
		}

	    return true;
	}

}	

?>