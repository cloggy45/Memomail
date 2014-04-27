<?php

class UserFixture extends CakeTestFixture
{
    public $import = array('model' => 'User');

    public $records = array(
        array(
            'id' => 1,
            'username' => 'UserTest',
            'password' => 'fc32478fd1f9830e79bacef25g64217s4b1b352a',
            'email' => 'thisistest@hotmail.com',
            'email_hash' => '4943b0050289b77df394b564d1f95c6c',
            'timezone' => 'America/Anguilla'
        )
    );
}