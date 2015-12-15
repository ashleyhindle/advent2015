<?php
namespace Parsers;

class AndOrNot implements ParserInterface
{
    private $regex = '/^(?<wire1>[a-z0-9]{1,3})? ?(?<type>[A-Z]{2,6}) (?<wire2>[a-z]{1,3}) -> (?<assignee>[a-z]{1,3})/';

    public function canParse($command)
    {
        return (preg_match($this->regex, $command) === 1);
    }

    public function parse($command)
    {
        preg_match($this->regex, $command, $matches);
        $matches = array_intersect_key($matches, array_flip(['type', 'wire1', 'wire2', 'value', 'assignee']));
        $matches['type'] = (empty($matches['type'])) ? 'ASSIGN' : $matches['type'];

        // array filter removes empty values (wire1 if it's NOT x -> y
        // array values reindexes the array as array_filter will have wire2 as index1 in the 'NOT' case
        $matches['wires'] = array_values(array_filter([$matches['wire1'], $matches['wire2']]));

        unset($matches['wire1']);
        unset($matches['wire2']);

        return $matches;
    }
}