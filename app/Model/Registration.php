<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Registration extends AppModel
{
    public $belongsTo = 'User';

    /**
     * @param $id
     * @return array
     */
    public function getRegValidStatus($id)
    {
        $temp = $this->find(
            'first',
            array(
                'conditions' => array('Registration.user_id' => $id),
                'fields' => 'Registration.reg_valid'
            )
        );

        return $temp[$this->alias]['reg_valid'];
    }

    /**
     * @param $hash string
     * @return bool
     */
    public function setRegIsValidStatus($hash)
    {
        if (strlen($hash) != 32) {
            return false;
        } else if ($this->updateAll(array('Registration.reg_valid' => true), array('Registration.hash' => $hash))) {
            return true;
        }
    }

    /**
     * @param $id
     * @param $email string
     * @return bool
     */
    public function saveEmailAsHash($id, $email)
    {
        $hashedEmail = Security::hash($email, 'sha1', true);

        if (empty($email)) {
            return false;
        } else if ($this->save(array('user_id' => $id, 'reg_valid' => 'false', 'hash' => $hashedEmail))) {
            return true;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmailHash($id)
    {
        $emailHash = $this->find(
            'first',
            array(
                'conditions' => array('Registration.id' => $id),
                'fields' => array('Registration.hash')
            )
        );

        return $emailHash[$this->alias]['hash'];
    }


}