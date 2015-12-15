<?php

class CommandParserTest extends PHPUnit_Framework_TestCase
{
    public function testClassCanBeCreated()
    {
        $this->assertInstanceOf('CommandParser', new CommandParser('123 -> x'));
    }

    public function testThrowsExceptionWithBadData()
    {
        $this->setExpectedException('InvalidArgumentException');
        new CommandParser('this will not validate');
    }

    public function testBasicAssignment()
    {
        $expected = [
            'type' => 'ASSIGN',
            'assignee' => 'x',
            'value' => 123
        ];

        $cmdParser = new CommandParser('123 -> x');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'Command was not parsed correctly');
    }

    public function testBasicAssignmentWithLongerIdentifier()
    {
        $expected = [
            'type' => 'ASSIGN',
            'assignee' => 'xxx',
            'value' => 123
        ];

        $cmdParser = new CommandParser('123 -> xxxx');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'Command was not parsed correctly');
    }

    public function testAndGate()
    {
        $expected = [
            'type' => 'AND',
            'assignee' => 'd',
            'wires' => ['x', 'y']
        ];

        $cmdParser = new CommandParser('x AND y -> d');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'AND gate command not parsed correctly');
    }

    public function testAndGateWithNumber()
    {
        $expected = [
            'type' => 'AND',
            'assignee' => 'd',
            'wires' => [1, 'fi']
        ];

        $cmdParser = new CommandParser('1 AND fi -> d');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'AND gate command with numbers not parsed correctly');
    }

    public function testOrGate()
    {
        $expected = [
            'type' => 'OR',
            'assignee' => 'd',
            'wires' => ['x', 'y']
        ];

        $cmdParser = new CommandParser('x OR y -> d');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'OR gate command not parsed correctly');
    }

    public function testLshiftGate()
    {
        $expected = [
            'type' => 'LSHIFT',
            'assignee' => 'd',
            'wires' => ['x', 'y']
        ];

        $cmdParser = new CommandParser('x LSHIFT y -> d');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'LSHIFT gate command not parsed correctly');
    }

    public function testRshiftGate()
    {
        $expected = [
            'type' => 'RSHIFT',
            'assignee' => 'd',
            'wires' => ['x', 'y']
        ];

        $cmdParser = new CommandParser('x RSHIFT y -> d');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'RSHIFT gate command not parsed correctly');
    }

    public function testNotGate()
    {
        $expected =[
            'type' => 'NOT',
            'assignee' => 'h',
            'wires' => ['x']
        ];

        $cmdParser = new CommandParser('NOT x -> h');
        $this->assertEquals($expected, $cmdParser->getCommand(), 'NOT gate command not parsed correctly');
    }
}