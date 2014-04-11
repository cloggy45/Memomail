<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    public $useTable = 'users';
    public $hasOne = 'Registration';

    public $hasMany = array(
        'Reminder' => array(
            'className' => 'Reminder'
        )
    );

    private $confirm_email = null;
    private $confirm_password = null;

    public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Alphabets and numbers only'
            ),
            'between' => array(
                'rule' => array('between', 5, 15),
                'message' => 'Between 5 to 15 characters'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Username is already taken'
            )
        ),
        'password' => array(
            'between' => array(
                'rule' => array('between', 5, 20),
                'message' => 'Between 5 to 20',
            ),
            'compareFields' => array(
                'rule' => array('compareFields', 'confirm_password'),
                'message' => 'Passwords do not match',
            )
        ),
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Please enter valid email address',
                'required' => 'create'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Email is already in use',
            ),
            'compareFields' => array(
                'rule' => array('compareFields', 'confirm_email'),
                'message' => 'Emails do not match',
                'required' => 'update'
            )
        ),
        'timezone' => array(
            'isValid' => array(
                'rule' => 'isValid',
                'message' => 'Please select a timezone',
                'required' => 'create'
            )
        )
    );

    /**
     * @param $confirmEmail
     * @return bool
     */
        public function setConfirmEmail($confirmEmail) {

        if(empty($confirmEmail)) {
            return false;
        } else {
            $this->confirm_email = $confirmEmail;
            return true;
        }
    }

    /**
     * @param $confirmPassword
     * @return bool
     */
    public function setConfirmPassword($confirmPassword) {
        if(empty($confirmPassword)) {
            return false;
        } else {
            $this->confirm_password = $confirmPassword;
            return true;
        }
    }

    /**
     * @param $check array
     * @return bool
     */
    public function isValid($check)
    {
        $value = array_values($check);

        if (empty($value[0])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $check array
     * @param null $comparedField
     * @return bool
     */
    public function compareFields($check, $comparedField)
    {
        $fieldOne = array_values($check);

        if ($fieldOne[0] == $this->data[$this->alias][$comparedField]) {
            return true;
        } else {
            return false;
        }
    }


    public function beforeValidate()
    {

        if (isset($this->confirm_email)) {
            $this->data[$this->alias]['confirm_email'] = $this->confirm_email;
        }

        if (isset($this->confirm_password)) {
            $this->data[$this->alias]['confirm_password'] = $this->confirm_password;
        }
    }


    public function beforeSave($options = array())
    {

        if (!empty($this->data[$this->alias]['password'])) {

            $passwordHasher = new SimplePasswordHasher();

            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }

        return true;
    }

    public function getUserId($field, $value)
    {

        $fieldName = $this->alias . "." . $field;

        $temp = $this->find(
            'first',
            array(
                'conditions' => array($fieldName => $value),
                'fields' => array('User.id')
            )
        );

        return $temp[$this->alias]['id'];
    }

    public function checkValueExists($field, $userEmail)
    {
        if ($this->find(
            'first',
            array(
                'conditions' => array(
                    $field => $userEmail
                )
            )
        )
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserDetails($id, $userField)
    {

        $userDetails = $this->find(
            'first',
            array(
                'conditions' => array('User.id' => $id),
                'fields' => $userField
            )
        );

        return $userDetails[$this->alias][$userField];
    }

    public function saveEmailHash($id, $email)
    {
        $hashedEmail = Security::hash($email, 'sha1', true);

        $this->id = $id;

        if ($this->saveField('email_hash',$hashedEmail))
        {
            return true;
        } else {
            return false;
        }
    }

    public function getEmailHash($id)
    {
        $emailHash = $this->find(
            'first',
            array(
                'conditions' => array('User.id' => $id),
                'fields' => array('User.email_hash')
            )
        );

        return $emailHash[$this->alias]['email_hash'];
    }


}

?>