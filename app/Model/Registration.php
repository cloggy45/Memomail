<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Registration extends AppModel
{
    public $belongsTo = 'User';

    public function getRegValidStatus($id)
    {

        $temp = $this->find(
            'first',
            array(
                'conditions' => array('Registration.user_id' => $id),
                'fields' => 'Registration.reg_valid'
            )
        );

        return $temp['Registration']['reg_valid'];
    }


    public function getRegHashValidStatus($hash)
    {

        if ($this->updateAll(
            array('Registration.reg_valid' => true),
            array('Registration.hash' => $hash)
        )
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function saveEmailHash($id, $email)
    {

        $hashedEmail = Security::hash($email, 'sha1', true);

        if ($this->save(
            array(
                'user_id' => $id,
                'reg_valid' => 'false',
                'hash' => $hashedEmail
            )
        )
        ) {
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
                'conditions' => array('Registration.id' => $id),
                'fields' => array('Registration.hash')
            )
        );

        return $emailHash['Registration']['hash'];
    }


}