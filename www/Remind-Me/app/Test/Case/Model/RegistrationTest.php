<?php

App::uses('Registration','Model');

class RegistrationTest extends CakeTestCase
{
    public $fixtures = array('app.registration','app.user');

    public function setUp()
    {
        parent::setUp();

        $this->Registration = ClassRegistry::init('Registration');
        $this->loadFixtures('User');
    }

    public function tearDown()
    {
        unset($this->Registration);
        parent::tearDown();
    }

    public function testGetRegValidStatus()
    {
        $expected = 1;
        $actual = $this->Registration->getRegValidStatus(1);
        $message = 'Did not return valid TRUE reg valid status';

        $this->assertEquals($expected,$actual,$message);
    }

    public function testSetRegIsValidStatusReturnsTrue()
    {
        $preExistingHash = '244c2459380bc229039be8edf4d91ef9';
        $isTrue = $this->Registration->setRegIsValidStatus($preExistingHash);

        $this->assertTrue($isTrue);
    }

    public function testSetRegIsValidStatusReturnsFalse()
    {
        $preExistingHash = '';
        $isFalse = $this->Registration->setRegIsValidStatus($preExistingHash);
        $this->assertFalse($isFalse);
    }

    public function testSaveEmailAsHashReturnsTrue()
    {
        $uid = '2';
        $email = 'test@hotmail.co.uk';

        $isTrue = $this->Registration->saveEmailAsHash($uid,$email);
        $this->assertTrue($isTrue);
    }

    public function testSaveEmailAsHashReturnsFalse()
    {
        $id = 1;
        $email = '';
        $isFalse = $this->Registration->saveEmailAsHash($id,$email);

        $this->assertFalse($isFalse);
    }

    public function testGetEmailHash()
    {
        $expected = '244c2459380bc229039be8edf4d91ef9';
        $actual = $this->Registration->getEmailHash('1');
        $message = 'Hash cannot be found';

        $this->assertEquals($expected,$actual,$message);
    }

}