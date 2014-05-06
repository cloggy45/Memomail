<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    public $useTable = 'users';
    public $hasOne = array('Registration');

    public $hasMany = array(
        'Reminder' => array(
            'className' => 'Reminder'
        )
    );

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