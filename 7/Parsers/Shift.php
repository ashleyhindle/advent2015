<?php
namespace Parsers;

class Shift implements ParserInterface
{
    private $regex = '/^(?<wire1>[a-z]{1,3})? ?(?<type>[A-Z]{2,6}) (?<value>[0-9]{1,5}) -> (?<assignee>[a-z]{1,3})/';

    public function canParse($command)
    {
        return (preg_match($this->regex, $command) === 1);
    }

    public function parse($command)
    {
        preg_match($this->regex, $command, $matches);
        $matches = array_intersect_key($matches, array_flip(['type', 'wire1', 'value', 'assignee']));
        $matches['type'] = (empty($matches['type'])) ? 'ASSIGN' : $matches['type'];
        $matches['wires'] = [$matches['wire1']];

        unset($matches['wire1']);

        return $matches;
    }
}