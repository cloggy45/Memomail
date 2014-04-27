<?php

class RegistrationFixture extends CakeTestFixture
{
    public $import = array('model' => 'Registration');

    public $records = array(
        array(
            'id' => 1,
            'user_id' => '1',
            'hash' => '244c2459380bc229039be8edf4d91ef9',
            'reg_valid' => '1'
        )
    );
}