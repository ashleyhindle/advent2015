<?php

class CircuitTest extends PHPUnit_Framework_TestCase
{
    public function testClassCanBeCreated()
    {
        $this->assertInstanceOf('Circuit', new Circuit());
    }

    public function testAddWireReturnsTrue()
    {
        $wire = new Wire('a');
        $circuit = new Circuit();
        $this->assertEquals(true, $circuit->addWire($wire));
    }

    public function testWireCountIsCorrect()
    {
        $wire1 = new Wire('a');
        $wire2 = new Wire('b');
        $circuit = new Circuit();
        $circuit->addWire($wire1);
        $circuit->addWire($wire2);

        $this->assertCount(2, $circuit->getWires());
    }

    public function testWireCountIsCorrectWithDuplicateNames()
    {
        $wire1 = new Wire('a');
        $wire2 = new Wire('a');
        $circuit = new Circuit();
        $circuit->addWire($wire1);
        $circuit->addWire($wire2);

        $this->assertCount(1, $circuit->getWires());
    }

    public function testWireCountIsCorrectWithGettingMultipleSpecificIdentifiers()
    {
        $wire1 = new Wire('a');
        $wire2 = new Wire('b');
        $wire3 = new Wire('c');

        $circuit = new Circuit();
        $circuit->addWire($wire1);
        $circuit->addWire($wire2);
        $circuit->addWire($wire3);

        $this->assertCount(2, $circuit->getWires(['a', 'b']));
    }

    public function testWireCountIsZeroToStart()
    {
        $circuit = new Circuit();

        $this->assertCount(0, $circuit->getWires());
    }

    public function testGetExistingWireReturnsAWireObject()
    {
        $wire = new Wire('a');
        $circuit = new Circuit();
        $circuit->addWire($wire);

        $this->assertInstanceOf('Wire', $circuit->getWire('a'));
    }

    public function testNonExistentWireReturnsFalse()
    {
        $circuit = new Circuit();

        $this->assertFalse($circuit->getWire('a'), 'Getting non existent wire did not return false');
    }
}