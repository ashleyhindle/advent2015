<?php

class WireTest extends PHPUnit_Framework_TestCase
{
    public function testClassCanBeCreated()
    {
        $this->assertInstanceOf('Wire', new Wire('a'));
    }

    public function testIdentifierReturnedIsSame()
    {
        $this->assertEquals('a', (new Wire('a'))->getIdentifier());
    }

    public function testSignalOnStartIsZero()
    {
        $this->assertEquals(0, (new Wire('a'))->getSignal());
    }

    public function testCanSetAndGetSignal()
    {
        $wire = new Wire('a');
        $wire->setSignal(123);

        $this->assertEquals(123, $wire->getSignal());
    }
}