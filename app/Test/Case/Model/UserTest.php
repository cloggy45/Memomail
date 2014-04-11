<?php

App::uses('User','Model');

class UserTest extends CakeTestCase
{
    public $fixtures = array('app.user','app.reminder');

    public function setUp()
    {
        parent::setUp();

        $this->User = ClassRegistry::init('User');
        $this->loadFixtures('Reminder');
    }

    public function tearDown()
    {
        unset($this->User);
        parent::tearDown();
    }

    public function testSetConfirmEmailReturnsTrue()
    {
        $isTrue = $this->User->setConfirmEmail('testPassword@hotmail.co.uk');
        $this->assertTrue($isTrue);
    }

    public function testSetConfirmEmailReturnsFalse()
    {
        $isFalse = $this->User->setConfirmEmail('');
        $this->assertFalse($isFalse);
    }

    public function testSetConfirmPasswordReturnsTrue()
    {
        $isTrue = $this->User->setConfirmPassword('thisispass');
        $this->assertTrue($isTrue);
    }

    public function testSetconfirmPasswordReturnsFalse()
    {
        $isFalse = $this->User->setConfirmPassword('');
        $this->assertFalse($isFalse);
    }

    public function testIsValidReturnsTrue()
    {
        $validationArray = array('input' => 'America/Anguilla');
        $isTrue = $this->User->isValid($validationArray);

        $this->assertTrue($isTrue);
    }

    public function testIsValidReturnsFalse()
    {
        $validationArray = array('input' => '');
        $isFalse = $this->User->isValid($validationArray);

        $this->assertFalse($isFalse);
    }

    public function testCompareFieldsReturnsTrue()
    {
        $validationArray = array(
            'email' => 'test@hotmail.com',
        );

        $this->User->data['User']['confirm_email'] = 'test@hotmail.com';
        $isTrue = $this->User->compareFields($validationArray,'confirm_email');

        $this->assertTrue($isTrue);
    }

    public function testCompareFieldsReturnsFalse()
    {
        $validationArray = array(
            'email' => 'test@hotmail.com',
        );

        $this->User->data['User']['confirm_email'] = 'test@googlemail.com';
        $isFalse = $this->User->compareFields($validationArray,'confirm_email');

        $this->assertFalse($isFalse);
    }






}

?>