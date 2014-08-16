<?php

App::uses('Reminder','Model');

class ReminderTest extends CakeTestCase
{
    public $fixtures = array('app.reminder','app.user');

    public function setUp()
    {
        parent::setUp();
        $this->Reminder = ClassRegistry::init('Reminder');
        $this->loadFixtures('User');
    }

    public function tearDown()
    {
        unset($this->Reminder);
        parent::tearDown();
    }

    public function testGetReminderMethodReturnsAllRecords()
    {
        $expected = 3;
        $tmpArray = $this->Reminder->getReminders(1,'all');
        $message = "Array does not return 3 rows";

        $this->assertCount($expected,$tmpArray,$message);
    }

}