<?php

App::uses('SimplePasswordHasher','Controller/Component/Auth');

class User extends AppModel {
	public $useTable = 'users';

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
				'rule' => array('minLength', '8'),
				'message' => 'Minimum 8 characters long'
			),	
			'email' => array(
				'email' => array(
					'rule' => 'email',
					'required' => true,
					'message' => 'Please enter valid email addresse'
					),
				)
		);


	public function beforeSave($options = array()) {

	    if (isset($this->data[$this->alias]['password'])) {

	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }

	    return true;
	}

}	

?>