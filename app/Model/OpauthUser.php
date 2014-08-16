<?php

class OpauthUser extends AppModel
{
    public $useTable = 'opauth_users';

    public $validate = array(
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Please enter valid email address',
                'required' => 'create'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Email is already in use'
            )
        )
    );

    public function beforeValidate($options = Array()) {
        print_r($options);
        // Checking email address inside OpauthUser during the registration process.
        if(array_key_exists('User', $this->data[$this->alias])) {

            // Validation doesn't work on deeply nested arrays, so we have to make our own
            $this->data[$this->alias]['email'] = $this->data[$this->alias]['User']['email'];
        }
    }

    public function userExists($uid)
    {
        if($this->find('count', array('conditions' => array('id' => $uid))) == 0)
            return false;
        else
            return true;
    }

    public function userHasSetTimezoneAndEmail($uid)
    {
        if($this->find('count', array('conditions' => array('id' => $uid, 'email' => "empty"))) != 0 || $this->find('count', array('conditions' => array('id' => $uid, 'timezone' => "empty"))) != 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getOpauthUserDetails($id, $userField)
    {
        $userDetails = $this->find(
            'first',
            array(
                'conditions' => array('id' => $id),
                'fields' => $userField
            )
        );

        return $userDetails[$this->alias][$userField];
    }
}