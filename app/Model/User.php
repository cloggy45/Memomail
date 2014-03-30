<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    public $useTable = 'users';

    public $hasMany = array(
        'Reminder' => array(
            'className' => 'Reminder'
        )
    );

    public $hasOne = 'Registration';

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


    public $confirm_email = null;
    public $confirm_password = null;

    public function isValid($check)
    {

        $value = array_values($check);

        if (empty($value[0])) {
            return false;
        } else {
            return true;
        }
    }

    public function compareFields($check, $comparedField = null)
    {
        $fieldOne = array_values($check);
        if ($fieldOne[0] == $this->data[$this->alias][$comparedField]) {
            return true;
        }
    }

    public function beforeValidate($options = array())
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

        return $temp['User']['id'];
    }

    public function checkEmailExists($userEmail)
    {
        if ($this->find(
            'first',
            array(
                'conditions' => array(
                    'email' => $userEmail
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

        return $emailHash['User']['email_hash'];
    }


}

?>